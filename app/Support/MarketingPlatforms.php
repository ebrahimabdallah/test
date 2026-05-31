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
            ['name' => 'Salla', 'url' => asset('images/platforms/salla.svg')],
            ['name' => 'Zid', 'url' => asset('images/platforms/zid.svg')],
            ['name' => 'Shopify', 'url' => asset('images/platforms/shopify.svg')],
            ['name' => 'Meta', 'url' => asset('images/platforms/meta.svg')],
            ['name' => 'Google Ads', 'url' => asset('images/platforms/google-ads.svg')],
            ['name' => 'TikTok', 'url' => asset('images/platforms/tiktok.svg')],
            ['name' => 'Snapchat', 'url' => asset('images/platforms/snapchat.svg')],
            ['name' => 'WooCommerce', 'url' => asset('images/platforms/woocommerce.svg')],
        ];
    }
}
