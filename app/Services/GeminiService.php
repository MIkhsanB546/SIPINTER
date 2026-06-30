<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class GeminiService
{
    protected string $apiKey;
    protected string $model;
    protected string $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
        $this->model = config('services.gemini.model');
        $this->baseUrl = 'https://generativelanguage.googleapis.com/v1beta';
    }

    public function summarizePdf(string $pdfText): string
    {
        $prompt = $this->buildSummaryPrompt($pdfText);

        $response = $this->sendRequest($prompt);

        return $this->cleanSummaryText($response);
    }

    public function generateQuiz(string $pdfText, ?string $userPrompt = null): array
    {
        $prompt = $this->buildQuizPrompt($pdfText, $userPrompt);
        $response = $this->sendRequest($prompt);

        $response = $this->stripMarkdown($response);

        $quizData = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('Gemini gagal menghasilkan format JSON yang valid.');
        }

        if (empty($quizData) || !is_array($quizData)) {
            throw new \RuntimeException('Data quiz yang dihasilkan kosong atau tidak valid.');
        }

        foreach ($quizData as $index => $item) {
            if (!isset($item['question'], $item['options'], $item['correct_answer'])) {
                throw new \RuntimeException("Format data soal ke-" . ($index + 1) . " tidak lengkap.");
            }
            if (!is_array($item['options']) || count($item['options']) < 2) {
                throw new \RuntimeException("Soal ke-" . ($index + 1) . " harus memiliki minimal 2 pilihan jawaban.");
            }
        }

        return $quizData;
    }

    protected function buildSummaryPrompt(string $pdfText): string
    {
        return "Buatlah ringkasan dari materi berikut dalam Bahasa Indonesia.\n\n"

            . "ATURAN YANG WAJIB DIIKUTI:\n"

            . "- Gunakan Bahasa Indonesia yang baik dan benar.\n"
            . "- Gunakan bahasa yang mudah dipahami siswa.\n"
            . "- Ringkas namun tetap mempertahankan konsep penting.\n"
            . "- Jangan menambahkan informasi di luar materi.\n"
            . "- Maksimal sekitar 500 kata.\n"
            . "- Gunakan paragraf biasa.\n"
            . "- Jangan menggunakan Markdown dalam bentuk apa pun.\n"
            . "- Jangan gunakan **bold**.\n"
            . "- Jangan gunakan *italic*.\n"
            . "- Jangan gunakan heading (# atau ##).\n"
            . "- Jangan gunakan tabel.\n"
            . "- Jangan gunakan code block.\n"
            . "- Jangan gunakan ```.\n"
            . "- Jangan gunakan emoji.\n"
            . "- Hasil harus berupa plain text yang siap langsung dimasukkan ke textarea Laravel.\n\n"

            . "Materi:\n{$pdfText}";
    }

    protected function buildQuizPrompt(string $pdfText, ?string $userPrompt = null): string
    {
        $prompt = "Secara default buatlah 5 soal pilihan ganda.\n\n"
            . "Namun apabila guru memberikan instruksi mengenai jumlah soal, ikuti instruksi guru tersebut.\n\n"
            . "Ketentuan:\n"
            . "- Setiap soal memiliki 4 pilihan jawaban\n"
            . "- Satu jawaban benar\n"
            . "- Sertakan penjelasan singkat untuk jawaban benar\n"
            . "- Output WAJIB berupa JSON array tanpa markdown dan tanpa teks lain\n\n"
            . "Format JSON:\n"
            . "[\n"
            . "  {\n"
            . "    \"question\": \"Pertanyaan?\",\n"
            . "    \"options\": [\"Pilihan A\", \"Pilihan B\", \"Pilihan C\", \"Pilihan D\"],\n"
            . "    \"correct_answer\": 0,\n"
            . "    \"explanation\": \"Penjelasan singkat\"\n"
            . "  }\n"
            . "]\n\n";

        if (!empty($userPrompt)) {
            $prompt .= "Instruksi tambahan dari guru:\n{$userPrompt}\n\n"
                . "Instruksi tambahan ini harus diprioritaskan selama masih sesuai dengan isi materi PDF.\n"
                . "Jangan membuat soal di luar materi PDF.\n\n";
        }

        $prompt .= "Teks:\n{$pdfText}";

        return $prompt;
    }

    protected function stripMarkdown(string $text): string
    {
        $text = preg_replace('/^```(?:json)?\s*\n?/im', '', $text);
        $text = preg_replace('/\n?```\s*$/im', '', $text);
        return trim($text);
    }

    protected function cleanSummaryText(string $text): string
    {
        // Hilangkan code block
        $text = preg_replace('/```[\s\S]*?```/', '', $text);

        // Hilangkan heading markdown
        $text = preg_replace('/^\s*#{1,6}\s*/m', '', $text);

        // Bold
        $text = preg_replace('/\*\*(.*?)\*\*/', '$1', $text);

        // Italic
        $text = preg_replace('/\*(.*?)\*/', '$1', $text);

        // Bold underscore
        $text = preg_replace('/__(.*?)__/', '$1', $text);

        // Italic underscore
        $text = preg_replace('/_(.*?)_/', '$1', $text);

        // Bullet markdown
        $text = preg_replace('/^\s*[-*+]\s+/m', '- ', $text);

        // Rapikan spasi kosong berlebih
        $text = preg_replace("/\n{3,}/", "\n\n", $text);

        return trim($text);
    }

    protected function sendRequest(string $prompt): string
    {
        if (empty($this->apiKey)) {
            throw new \RuntimeException('API key Gemini belum dikonfigurasi.');
        }

        $url = "{$this->baseUrl}/models/{$this->model}:generateContent?key={$this->apiKey}";

        try {
            $response = Http::timeout(60)
                ->acceptJson()
                ->post($url, [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt],
                            ],
                        ],
                    ],
                ]);

            $response->throw();
        } catch (ConnectionException $e) {
            throw new \RuntimeException(
                'Permintaan ke Gemini timeout atau koneksi gagal.'
            );
        } catch (RequestException $e) {
            $status = $e->response?->status();

            throw match ($status) {
                401, 403 => new \RuntimeException('API Key Gemini tidak valid.'),
                429 => new \RuntimeException('Batas penggunaan Gemini tercapai. Silakan coba lagi beberapa saat.'),
                default => new \RuntimeException("Gemini mengembalikan HTTP {$status}."),
            };
        }

        $data = $response->json();

        $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

        if (empty($text)) {
            throw new \RuntimeException('Gemini tidak mengembalikan respons yang valid.');
        }

        return $text;
    }
}
