<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    $product = new \App\Models\SimpleProduct();
    echo "Testing SEO methods...\n";
    echo "getSeoTitle(): " . $product->getSeoTitle() . "\n";
    echo "Success: No undefined property error\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
