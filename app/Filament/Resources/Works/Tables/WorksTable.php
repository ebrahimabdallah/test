<?php

namespace App\Filament\Resources\Works\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WorksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category')
                    ->label('القسم')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'ecommerce'   => 'نتائج الحملات الإعلانية',
                        'restaurants' => 'نتائج السوشيال ميديا',
                        'systems'     => 'نتائج محركات البحث',
                        default       => $state,
                    })
                    ->searchable()
                    ->sortable(),
                ImageColumn::make('image')
                    ->label('الصورة')
                    ->disk('public'),
                TextColumn::make('name')
                    ->label('اسم العمل')
                    ->searchable(),
        
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
