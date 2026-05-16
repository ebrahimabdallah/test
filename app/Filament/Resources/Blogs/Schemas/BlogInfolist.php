<?php

namespace App\Filament\Resources\Blogs\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BlogInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title')
                    ->label('العنوان'),
                TextEntry::make('slug')
                    ->label('المعرف في الرابط'),
                IconEntry::make('is_published')
                    ->label('منشور')
                    ->boolean(),
                TextEntry::make('published_at')
                    ->label('تاريخ النشر')
                    ->dateTime()
                    ->placeholder('-'),
                ImageEntry::make('featured_image')
                    ->label('صورة مميزة'),
                TextEntry::make('excerpt')
                    ->label('مقتطف')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('content')
                    ->label('المحتوى')
                    ->html()
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
