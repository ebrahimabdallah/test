<?php

namespace App\Support;

class MarketingPlatforms
{
    /**
     * @return array<int, array{name: string, url: string}>
     */
    public static function logos(): array
    {
        return [
            ['name' => 'سلة', 'url' => asset('images/platforms/salla.svg')],
            ['name' => 'زد', 'url' => asset('images/platforms/zid.svg')],
            ['name' => 'شوبيفاي', 'url' => asset('images/platforms/shopify.svg')],
            ['name' => 'ميتا', 'url' => asset('images/platforms/meta.svg')],
            ['name' => 'إعلانات جوجل', 'url' => asset('images/platforms/google-ads.svg')],
            ['name' => 'تيك توك', 'url' => asset('images/platforms/tiktok.svg')],
            ['name' => 'سناب شات', 'url' => asset('images/platforms/snapchat.svg')],
            ['name' => 'ووكومرس', 'url' => asset('images/platforms/woocommerce.svg')],
        ];
    }
}
