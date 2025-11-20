<?php
// Placeholder for PhpSpreadsheet integration.
function export_excel_placeholder(string $title, array $rows): string
{
    $content = $title . "\n";
    foreach ($rows as $row) {
        $content .= implode(',', $row) . "\n";
    }
    $file = __DIR__ . '/../storage/temp/' . uniqid('excel_', true) . '.csv';
    file_put_contents($file, $content);
    return $file;
}
