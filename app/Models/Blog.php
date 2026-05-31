<?php

namespace App\Models;

use App\Support\ResolvesPublicStorageUrl;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use ResolvesPublicStorageUrl;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'is_published',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Blog $blog): void {
            if ($blog->is_published && $blog->published_at === null) {
                $blog->published_at = now();
            }
        });
    }

    /**
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('is_published', true)
            ->where(function (Builder $q): void {
                $q->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            })
            ->orderByDesc('published_at')
            ->orderByDesc('id');
    }

    public function featuredImageUrl(): ?string
    {
        return self::resolvePublicStorageUrl($this->featured_image);
    }

    public function formattedPublishedDate(): ?string
    {
        if ($this->published_at === null) {
            return null;
        }

        return $this->published_at->locale('ar')->translatedFormat('j F Y');
    }

    public function readingTimeMinutes(): int
    {
        $text = strip_tags((string) ($this->content ?? ''));
        $words = preg_split('/\s+/u', trim($text), -1, PREG_SPLIT_NO_EMPTY);

        return max(1, (int) ceil(count($words) / 200));
    }
}
