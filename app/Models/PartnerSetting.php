<?php

namespace App\Models;

use App\Support\ResolvesPublicStorageUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PartnerSetting extends Model
{
    use ResolvesPublicStorageUrl;

    protected $fillable = [
        'section_tag',
        'title',
        'description',
        'cta_text',
        'items',
    ];

    protected function casts(): array
    {
        return [
            'items' => 'array',
        ];
    }

    public static function settings(): self
    {
        return static::query()->firstOrCreate([], [
            'section_tag' => 'شركاء نجاحنا',
            'title' => 'عملاء بنوا ثمرتهم معانا',
            'description' => 'أكثر من 50 براند سعودي وخليجي وثقوا فينا وحققنا معاهم نتائج فعلية. كل لوجو هنا قصة نمو حقيقية.',
            'cta_text' => 'وأكثر من +50 براند آخر يبنون نجاحهم معانا كل يوم',
            'items' => [],
        ]);
    }

    /**
     * @return Collection<int, array{name: string, image_url: ?string, has_logo: bool}>
     */
    public function partnerItems(): Collection
    {
        return collect($this->items ?? [])
            ->filter(fn (mixed $item): bool => is_array($item) && filled($item['name'] ?? null))
            ->map(function (array $item): array {
                $imageUrl = self::resolvePublicStorageUrl($item['image'] ?? null);

                return [
                    'name' => trim((string) $item['name']),
                    'image_url' => $imageUrl,
                    'has_logo' => filled($imageUrl),
                ];
            })
            ->values();
    }
}
