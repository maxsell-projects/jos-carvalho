<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$props = \App\Models\Property::where('reference_code', 'like', 'TOP %')->orderBy('updated_at', 'desc')->take(5)->get();
foreach ($props as $p) {
    echo "Ref: {$p->reference_code} - Cover: {$p->cover_image}\n";
    $firstImage = $p->images()->first();
    echo "  First gallery image: " . ($firstImage ? $firstImage->path : 'none') . "\n";
}
