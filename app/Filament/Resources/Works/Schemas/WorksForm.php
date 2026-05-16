<?php

namespace App\Filament\Resources\Works\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class WorksForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category')
                    ->label('القسم')
                    ->options([
                        'ecommerce'   => 'نتائج الحملات الإعلانية',
                        'restaurants' => 'نتائج السوشيال ميديا',
                        'systems'     => 'نتائج محركات البحث',
                    ])
                    ->required()
                    ->native(false),

                TextInput::make('name')
                    ->label('اسم العمل')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('image')
                    ->label('صورة العمل')
                    ->image()
                    ->disk('public')
                    ->directory('works')
                    ->required(),

                RichEditor::make('description')
                    ->label('وصف العمل')
                    ->columnSpanFull(),
            ]);
    }
}