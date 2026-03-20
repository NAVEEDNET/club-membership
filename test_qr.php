<?php
require 'vendor/autoload.php';

use SimpleSoftwareIO\QrCode\Facades\QrCode;

try {
    $testPath = __DIR__ . '/storage/app/public/qrcodes/test_'.time().'.png';
    
    echo "Generating QR code to: " . $testPath . "\n";
    
    QrCode::format('png')
        ->size(300)
        ->generate('https://test.example.com', $testPath);
    
    if (file_exists($testPath)) {
        echo "✓ QR code generated successfully!\n";
        echo "File size: " . filesize($testPath) . " bytes\n";
    } else {
        echo "✗ File was not created\n";
    }
} catch (\Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
}
