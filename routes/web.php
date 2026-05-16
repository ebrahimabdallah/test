<?php

use App\Models\Blog;
use App\Models\Works;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    $works = Works::get();

    // Group works by category for the front-end JS
    $worksGrouped = $works->groupBy('category')->map(function ($items) {
        return $items->map(function ($item) {
            $path = $item->image;
            $imageUrl = '';
            if (filled($path)) {
                $path = is_array($path) ? ($path[0] ?? '') : $path;
                $path = is_string($path) ? trim($path) : '';
                if ($path !== '') {
                    if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
                        $imageUrl = $path;
                    } else {
                        $path = ltrim($path, '/');
                        if (str_starts_with($path, 'storage/')) {
                            $path = substr($path, strlen('storage/'));
                        }
                        $imageUrl = Storage::disk('public')->url($path);
                    }
                }
            }

            return [
                'name'        => trim(strip_tags((string) $item->name)),
                'type'        => $item->type ?? '',
                'theme'       => $item->theme ?? 'green',
                'cta'         => $item->cta ?? '',
                'features'    => $item->features ?? [],
                'image'       => $imageUrl,
                'description' => $item->description ?? '',
            ];
        })->values();
    });

    $blogs = Blog::query()->published()->limit(6)->get();

    return view('welcome', [
        'worksJson' => $worksGrouped->toJson(),
        'blogs' => $blogs,
    ]);
});

Route::get('/blog/{slug}', function (string $slug) {
    $blog = Blog::query()
        ->where('slug', $slug)
        ->published()
        ->firstOrFail();

    return view('blog.show', [
        'blog' => $blog,
    ]);
})->where('slug', '[^/]+')
    ->name('blog.show');
