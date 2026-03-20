<?php
require 'bootstrap/app.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$count = \App\Models\Member::count();
echo "Total members in database: " . $count . "\n";

if ($count > 0) {
    $member = \App\Models\Member::first();
    echo "Sample member: " . $member->full_name . "\n";
    echo "Member ID: " . $member->member_id . "\n";
}
