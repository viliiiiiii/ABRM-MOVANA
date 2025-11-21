<?php
// Placeholder for PDF exports using TCPDF/Dompdf.
function export_pdf_placeholder(string $title, array $rows): string
{
    $content = $title . "\n\n";
    foreach ($rows as $row) {
        $content .= implode(' | ', $row) . "\n";
    }
    $file = __DIR__ . '/../storage/temp/' . uniqid('pdf_', true) . '.txt';
    file_put_contents($file, $content);
    return $file;
}
