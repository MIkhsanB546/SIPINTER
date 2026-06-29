<?php

namespace App\Services;

use Smalot\PdfParser\Parser;

class PdfService
{
    protected Parser $parser;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function extractText(string $filePath): string
    {
        if (!file_exists($filePath)) {
            throw new \RuntimeException('File PDF tidak ditemukan.');
        }

        $pdf = $this->parser->parseFile($filePath);
        $text = $pdf->getText();

        if (empty(trim($text))) {
            throw new \RuntimeException('File PDF tidak mengandung teks yang dapat diekstrak.');
        }

        return $this->cleanText($text);
    }

    protected function cleanText(string $text): string
    {
        $text = preg_replace('/\s+/', ' ', $text);
        $text = preg_replace('/[^\p{L}\p{N}\p{P}\p{Z}\n]/u', '', $text);
        return trim($text);
    }
}
