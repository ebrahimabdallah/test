<?php

namespace App\Filament\Resources\Works\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class WorksInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('category')
                    ->label('القسم')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'ecommerce'   => 'نتائج الحملات الإعلانية',
                        'restaurants' => 'نتائج السوشيال ميديا',
                        'systems'     => 'نتائج محركات البحث',
                        default       => $state,
                    }),
                ImageEntry::make('image')
                    ->label('الصورة')
                    ->disk('public'),
                TextEntry::make('name')
                    ->label('اسم العمل'),
                TextEntry::make('type')
                    ->label('النوع')
                    ->placeholder('-'),
                TextEntry::make('description')
                    ->label('الوصف')
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
