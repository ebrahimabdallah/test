<?php

namespace App\Support;

trait ResolvesPublicStorageUrl
{
    protected static function resolvePublicStorageUrl(mixed $path): ?string
    {
        if (! filled($path)) {
            return null;
        }

        $path = is_array($path) ? ($path[0] ?? '') : $path;

        if (! is_string($path) || trim($path) === '') {
            return null;
        }

        $path = trim($path);

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        $path = ltrim($path, '/');

        if (str_starts_with($path, 'storage/')) {
            $path = substr($path, strlen('storage/'));
        }

        return asset('storage/'.$path);
    }
}
