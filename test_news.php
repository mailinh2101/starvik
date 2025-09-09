<?php

require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->boot();

try {
    $news = App\Models\News::first();
    if ($news) {
        echo "News found: " . $news->title . PHP_EOL;
        echo "Author: " . ($news->author ?? 'No author') . PHP_EOL;
        echo "Featured image: " . ($news->featured_image ?? 'No image') . PHP_EOL;
        echo "Image accessor: " . ($news->image ?? 'No image') . PHP_EOL;
        echo "SUCCESS: No relationship errors!" . PHP_EOL;
    } else {
        echo "No news found in database" . PHP_EOL;
    }
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
}
