<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AIProcessRequest;
use App\Models\Materi;
use App\Services\GeminiService;
use App\Services\PdfService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class AIController extends Controller
{
    protected PdfService $pdfService;
    protected GeminiService $geminiService;

    public function __construct(PdfService $pdfService, GeminiService $geminiService)
    {
        $this->pdfService = $pdfService;
        $this->geminiService = $geminiService;
    }

    public function summarize(AIProcessRequest $request): JsonResponse
    {
        try {
            $pdfPath = $this->getPdfPath($request);
            $text = $this->pdfService->extractText($pdfPath);
            $summary = $this->geminiService->summarizePdf($text);

            return response()->json([
                'success' => true,
                'data' => $summary,
            ]);
        } catch (\RuntimeException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function generateQuiz(AIProcessRequest $request): JsonResponse
    {
        try {
            $pdfPath = $this->getPdfPath($request);
            $text = $this->pdfService->extractText($pdfPath);
            $quizData = $this->geminiService->generateQuiz($text, $request->input('user_prompt'));

            return response()->json([
                'success' => true,
                'data' => $quizData,
            ]);
        } catch (\RuntimeException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    protected function getPdfPath(AIProcessRequest $request): string
    {
        if ($request->hasFile('file')) {
            return $request->file('file')->getRealPath();
        }

        if ($request->filled('materi_id')) {
            $materi = Materi::findOrFail($request->materi_id);

            if (!$materi->file_materi) {
                throw new \RuntimeException('Materi ini tidak memiliki file PDF.');
            }

            $path = Storage::disk('public')->path($materi->file_materi);

            if (!file_exists($path)) {
                throw new \RuntimeException('File PDF materi tidak ditemukan di penyimpanan.');
            }

            return $path;
        }

        throw new \RuntimeException('Tidak ada file PDF yang ditemukan. Silakan upload file PDF terlebih dahulu.');
    }
}
