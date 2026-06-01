<?php

namespace App\Models;

use App\Support\ResolvesPublicStorageUrl;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Partner extends Model
{
    use ResolvesPublicStorageUrl;

    public const MARQUEE_ROW_COUNT = 2;

    protected $fillable = [
        'image',
        'is_active',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeWithLogo(Builder $query): Builder
    {
        return $query
            ->whereNotNull('image')
            ->where('image', '!=', '');
    }

    /**
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('order')->orderBy('id');
    }

    /**
     * Active partners from the database that have a resolvable logo URL.
     *
     * @return EloquentCollection<int, static>
     */
    public static function forHomepage(): EloquentCollection
    {
        return static::query()
            ->active()
            ->withLogo()
            ->ordered()
            ->get()
            ->filter(fn (self $partner): bool => filled($partner->imageUrl()))
            ->values();
    }

    public function imageUrl(): ?string
    {
        return self::resolvePublicStorageUrl($this->image);
    }

    /**
     * Distribute partners across up to 2 rows (round-robin). Each partner appears once.
     * Rows with no partners are omitted.
     *
     * @param  Collection<int, static>|EloquentCollection<int, static>|null  $partners
     * @return Collection<int, Collection<int, static>>
     */
    public static function marqueeRows(
        Collection|EloquentCollection|null $partners = null,
        int $maxRows = self::MARQUEE_ROW_COUNT,
    ): Collection {
        $partners = ($partners ?? static::forHomepage())->values();

        if ($partners->isEmpty()) {
            return collect();
        }

        $rowCount = min($maxRows, $partners->count());
        $rows = collect(range(0, $rowCount - 1))->map(fn (): Collection => collect());

        foreach ($partners as $index => $partner) {
            $rows[$index % $rowCount]->push($partner);
        }

        return $rows->filter(fn (Collection $row): bool => $row->isNotEmpty())->values();
    }
}
