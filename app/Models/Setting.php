<?php

namespace App\Models;

use App\Support\ResolvesPublicStorageUrl;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use ResolvesPublicStorageUrl;

    protected $fillable = [
        'logo',
        'favicon',
        'whatsapp_number',
        'whatsapp_message',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'linkedin_url',
        'tiktok_url',
        'youtube_url',
        'snapchat_url',
        'telegram_url',
    ];

    public static function settings(): self
    {
        return static::query()->firstOrCreate([], [
            'whatsapp_number' => '966564702937',
            'whatsapp_message' => 'هلا، عندي متجر إلكتروني وما أدري وين المشكلة — التسويق؟ المنتج؟ المتجر؟ ممكن تساعدني أحدد من وين أبدأ؟',
        ]);
    }

    public function logoUrl(): ?string
    {
        return self::resolvePublicStorageUrl($this->logo) ?? asset('images/logo.svg');
    }

    public function faviconUrl(): ?string
    {
        return self::resolvePublicStorageUrl($this->favicon);
    }

    public function whatsappUrl(): string
    {
        $number = preg_replace('/\D+/', '', (string) $this->whatsapp_number) ?? '';

        if ($number === '') {
            return '#';
        }

        $url = 'https://wa.me/'.$number;

        if (filled($this->whatsapp_message)) {
            $url .= '?text='.rawurlencode($this->whatsapp_message);
        }

        return $url;
    }

    public function whatsappDisplay(): string
    {
        $number = preg_replace('/\D+/', '', (string) $this->whatsapp_number) ?? '';

        if ($number === '') {
            return '';
        }

        if (str_starts_with($number, '966')) {
            return '+966 '.substr($number, 3);
        }

        return '+'.$number;
    }

    /**
     * @return array<string, string|null>
     */
    public function socialLinks(): array
    {
        return array_filter([
            'twitter' => $this->twitter_url,
            'linkedin' => $this->linkedin_url,
            'instagram' => $this->instagram_url,
            'tiktok' => $this->tiktok_url,
            'facebook' => $this->facebook_url,
            'youtube' => $this->youtube_url,
            'snapchat' => $this->snapchat_url,
            'telegram' => $this->telegram_url,
        ], fn (?string $url): bool => filled($url));
    }
}
