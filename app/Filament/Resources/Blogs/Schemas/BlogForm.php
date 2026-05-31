<?php

namespace App\Filament\Resources\Blogs\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BlogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('العنوان')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (?string $state, Set $set, callable $get): void {
                        if (! filled($state) || filled($get('slug'))) {
                            return;
                        }
                        $slug = Str::slug($state);
                        if ($slug === '') {
                            $slug = 'post-'.substr(hash('sha256', $state), 0, 10);
                        }
                        $set('slug', $slug);
                    }),
                TextInput::make('slug')
                    ->label('المعرف في الرابط')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->alphaDash(),
                Textarea::make('excerpt')
                    ->label('مقتطف')
                    ->rows(3)
                    ->maxLength(500)
                    ->columnSpanFull(),
                FileUpload::make('featured_image')
                    ->label('صورة مميزة')
                    ->image()
                    ->disk('public')
                    ->directory('blogs')
                    ->visibility('public'),
                RichEditor::make('content')
                    ->label('المحتوى')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('is_published')
                    ->label('منشور')
                    ->default(false),
                DateTimePicker::make('published_at')
                    ->label('تاريخ النشر')
                    ->seconds(false)
                    ->native(false),
            ]);
    }
}
