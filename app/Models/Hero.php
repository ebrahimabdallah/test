<?php

namespace App\Models;

use App\Support\ResolvesPublicStorageUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Hero extends Model
{
    use ResolvesPublicStorageUrl;

    protected $fillable = [
        'images',
    ];

    protected function casts(): array
    {
        return [
            'images' => 'array',
        ];
    }

    public static function settings(): self
    {
        return static::query()->firstOrCreate([], [
            'images' => [],
        ]);
    }

    /**
     * @return Collection<int, string>
     */
    public function imageUrls(): Collection
    {
        return collect($this->images ?? [])
            ->map(fn (mixed $path): ?string => self::resolvePublicStorageUrl($path))
            ->filter()
            ->values();
    }
}
