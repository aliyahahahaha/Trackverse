<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$statuses = Illuminate\Support\Facades\DB::table('member_availabilities')->distinct()->pluck('status');
echo "DISTINCT STATUSES: " . $statuses->implode(', ') . PHP_EOL;

foreach (Illuminate\Support\Facades\DB::table('member_availabilities')->get() as $r) {
    echo "ID: $r->id | Status: $r->status" . PHP_EOL;
}
