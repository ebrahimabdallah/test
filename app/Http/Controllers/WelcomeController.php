<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Partner;
use App\Models\Testmoianl;
use App\Models\Works;
use App\Support\MarketingPlatforms;
use App\Support\ResolvesPublicStorageUrl;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class WelcomeController extends Controller
{
    use ResolvesPublicStorageUrl;

    public function index(): View
    {
        $partners = Partner::forHomepage();
        $testimonialSetting = Testmoianl::settings();

        $partnerRows = Partner::marqueeRows($partners)->map(
            fn (Collection $row, int $rowIndex): array => [
                'partners' => $row->values(),
                'reverse' => $rowIndex % 2 === 1,
                'rowIndex' => $rowIndex,
            ]
        );

        return view('welcome', [
            'blogs' => Blog::query()->published()->limit(6)->get(),
            'partners' => $partners,
            'partnerRows' => $partnerRows,
            'partnersCount' => $partners->count(),
            'platformLogos' => MarketingPlatforms::logos(),
            'testimonialImages' => $testimonialSetting->imageUrls(),
            'worksJson' => $this->worksGroupedJson(),
        ]);
    }

    public function showBlog(string $slug): View
    {
        $blog = Blog::query()
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        return view('blog.show', [
            'blog' => $blog,
            'pageTitle' => $blog->title.' — ثمرة',
        ]);
    }

    private function worksGroupedJson(): string
    {
        $worksGrouped = Works::query()->get()->groupBy('category')->map(function ($items) {
            return $items->map(function ($item) {
                return [
                    'name' => trim(strip_tags((string) $item->name)),
                    'type' => $item->type ?? '',
                    'theme' => $item->theme ?? 'green',
                    'cta' => $item->cta ?? '',
                    'features' => $item->features ?? [],
                    'image' => self::resolvePublicStorageUrl($item->image) ?? '',
                    'description' => $item->description ?? '',
                ];
            })->values();
        });

        return $worksGrouped->toJson();
    }
}
