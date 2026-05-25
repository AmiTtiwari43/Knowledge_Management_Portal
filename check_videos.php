<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$course = \App\Models\Course::where('slug', '7-din-mai-lamba-kese-kre')->first();
if ($course) {
    print_r($course->sections->flatMap->lectures->pluck('video_url', 'title')->toArray());
} else {
    echo "Course not found\n";
}
