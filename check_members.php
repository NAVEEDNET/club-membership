<?php
use App\Models\Member;
use Illuminate\Support\Facades\Log;

require __DIR__ . '/bootstrap/app.php';

$app = app();
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Checking database for members...\n";

try {
    $members = Member::all();
    echo "Total members in database: " . count($members) . "\n";
    
    if ($members->count() > 0) {
        foreach ($members as $member) {
            echo "Member ID: {$member->id}, QR Code: " . ($member->qr_code ? 'YES (' . $member->qr_code . ')' : 'NO') . "\n";
        }
    } else {
        echo "No members found in database.\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
