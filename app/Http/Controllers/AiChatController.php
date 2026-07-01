<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Quiz;
use App\Services\GeminiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AiChatController extends Controller
{
    protected GeminiService $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    public function chat(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $message = $validated['message'];

        try {
            $materials = $this->searchMaterials($message);
            $quizzes = $this->searchQuizzes($message);

            $response = $this->geminiService->chatWithContext($message, $materials, $quizzes);
            $response = $this->stripMarkdown($response);

            $parsed = json_decode($response, true);

            if (json_last_error() !== JSON_ERROR_NONE || !isset($parsed['reply'])) {
                $fallback = $this->geminiService->chat($message);

                return response()->json([
                    'success' => true,
                    'data' => $fallback,
                    'action' => null,
                    'action_url' => null,
                ]);
            }

            $action = $this->validateAction($parsed['action'] ?? null);

            return response()->json([
                'success' => true,
                'data' => $parsed['reply'],
                'action' => $action,
                'action_url' => $action ? $this->actionToUrl($action) : null,
            ]);
        } catch (\RuntimeException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Maaf, AI sedang tidak dapat dihubungi. Silakan coba lagi.',
            ], 503);
        }
    }

    protected function searchMaterials(string $message): array
    {
        $keywords = explode(' ', $message);

        return Materi::where('is_published', true)
            ->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $word = trim($word);
                    if (strlen($word) >= 3) {
                        $q->orWhere('judul', 'like', "%{$word}%");
                    }
                }
            })
            ->limit(5)
            ->get(['id_materi as id', 'judul'])
            ->toArray();
    }

    protected function searchQuizzes(string $message): array
    {
        $keywords = explode(' ', $message);

        return Quiz::where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $word = trim($word);
                    if (strlen($word) >= 3) {
                        $q->orWhere('judul', 'like', "%{$word}%");
                    }
                }
            })
            ->limit(5)
            ->get(['id_quiz as id', 'judul'])
            ->toArray();
    }

    protected function validateAction(?array $action): ?array
    {
        if (!$action || !isset($action['type'])) {
            return null;
        }

        $type = $action['type'];

        $allowedTypes = [
            'open_material',
            'open_quiz',
            'open_dashboard',
            'open_profile',
            'open_saved_materials',
            'open_learning_progress',
            'open_quiz_history',
            'search_material',
        ];

        if (!in_array($type, $allowedTypes)) {
            return null;
        }

        if ($type === 'open_material') {
            $id = $action['material_id'] ?? null;
            if (!$id || !Materi::where('id_materi', $id)->exists()) {
                return null;
            }
        }

        if ($type === 'open_quiz') {
            $id = $action['quiz_id'] ?? null;
            if (!$id || !Quiz::where('id_quiz', $id)->exists()) {
                return null;
            }
        }

        return [
            'type' => $type,
            'material_id' => $action['material_id'] ?? null,
            'quiz_id' => $action['quiz_id'] ?? null,
            'button' => $action['button'] ?? 'Buka',
        ];
    }

    protected function actionToUrl(array $action): ?string
    {
        return match ($action['type']) {
            'open_material' => $action['material_id']
                ? route('siswa.materi.show', $action['material_id'])
                : null,

            'open_quiz' => $action['quiz_id']
                ? route('siswa.quiz.start', $action['quiz_id'])
                : null,

            'open_dashboard' => auth()->user()->role === 'siswa'
                ? route('siswa.dashboard')
                : route('dashboard.index'),

            'open_profile' => route('siswa.profile'),

            'open_saved_materials' => route('siswa.my-learning'),

            'open_learning_progress' => route('siswa.my-learning'),

            'open_quiz_history' => route('siswa.quiz.history'),

            'search_material' => route('siswa.browse.index'),

            default => null,
        };
    }

    protected function stripMarkdown(string $text): string
    {
        $text = preg_replace('/^```(?:json)?\s*\n?/im', '', $text);
        $text = preg_replace('/\n?```\s*$/im', '', $text);

        return trim($text);
    }
}
