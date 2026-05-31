<?php

namespace App\Filament\Pages;

use App\Models\Setting as SiteSetting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\CanUseDatabaseTransactions;
use Filament\Pages\Concerns\HasUnsavedDataChangesAlert;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Exceptions\Halt;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Throwable;

class Setting extends Page
{
    use CanUseDatabaseTransactions;
    use HasUnsavedDataChangesAlert;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $navigationLabel = 'إعدادات الموقع';

    protected static ?string $title = 'إعدادات الموقع';

    protected static ?string $slug = 'settings';

    protected static ?int $navigationSort = 99;

    protected string $view = 'filament-panels::pages.page';

    /**
     * @var array<string, mixed>|null
     */
    public ?array $data = [];

    public ?SiteSetting $record = null;

    public function mount(): void
    {
        $this->record = SiteSetting::settings();
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('الشعار')
                    ->schema([
                        FileUpload::make('logo')
                            ->label('شعار الموقع')
                            ->image()
                            ->disk('public')
                            ->directory('site')
                            ->maxSize(2048),
                        FileUpload::make('favicon')
                            ->label('أيقونة المتصفح')
                            ->image()
                            ->disk('public')
                            ->directory('site')
                            ->maxSize(512),
                    ])
                    ->columns(2),
                Section::make('واتساب')
                    ->schema([
                        TextInput::make('whatsapp_number')
                            ->label('رقم واتساب')
                            ->tel()
                            ->placeholder('966564702937')
                            ->helperText('أرقام فقط مع رمز الدولة بدون + أو مسافات')
                            ->maxLength(20),
                        Textarea::make('whatsapp_message')
                            ->label('رسالة واتساب الافتراضية')
                            ->rows(4)
                            ->helperText('تُرسل تلقائياً عند الضغط على أزرار التواصل')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('وسائل التواصل')
                    ->schema([
                        TextInput::make('twitter_url')
                            ->label('X / تويتر')
                            ->url()
                            ->placeholder('https://x.com/...')
                            ->maxLength(255),
                        TextInput::make('linkedin_url')
                            ->label('لينكدإن')
                            ->url()
                            ->placeholder('https://linkedin.com/...')
                            ->maxLength(255),
                        TextInput::make('instagram_url')
                            ->label('إنستغرام')
                            ->url()
                            ->placeholder('https://instagram.com/...')
                            ->maxLength(255),
                        TextInput::make('tiktok_url')
                            ->label('تيك توك')
                            ->url()
                            ->placeholder('https://tiktok.com/...')
                            ->maxLength(255),
                        TextInput::make('facebook_url')
                            ->label('فيسبوك')
                            ->url()
                            ->placeholder('https://facebook.com/...')
                            ->maxLength(255),
                        TextInput::make('youtube_url')
                            ->label('يوتيوب')
                            ->url()
                            ->placeholder('https://youtube.com/...')
                            ->maxLength(255),
                        TextInput::make('snapchat_url')
                            ->label('سناب شات')
                            ->url()
                            ->placeholder('https://snapchat.com/...')
                            ->maxLength(255),
                        TextInput::make('telegram_url')
                            ->label('تيليجرام')
                            ->url()
                            ->placeholder('https://t.me/...')
                            ->maxLength(255),
                    ])
                    ->columns(2),
            ]);
    }

    public function defaultForm(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->model($this->record)
            ->operation('edit')
            ->statePath('data');
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getFormContentComponent(),
            ]);
    }

    protected function getFormContentComponent(): Form
    {
        return Form::make([EmbeddedSchema::make('form')])
            ->id('form')
            ->livewireSubmitHandler('save')
            ->footer([
                Actions::make([
                    Action::make('save')
                        ->label('حفظ الإعدادات')
                        ->submit('save')
                        ->keyBindings(['mod+s']),
                ])
                    ->alignment($this->getFormActionsAlignment())
                    ->key('form-actions'),
            ]);
    }

    public function save(): void
    {
        try {
            $this->beginDatabaseTransaction();

            $data = $this->form->getState();

            $this->record?->update($data);
        } catch (Halt $exception) {
            $exception->shouldRollbackDatabaseTransaction() ?
                $this->rollBackDatabaseTransaction() :
                $this->commitDatabaseTransaction();

            return;
        } catch (Throwable $exception) {
            $this->rollBackDatabaseTransaction();

            throw $exception;
        }

        $this->commitDatabaseTransaction();

        $this->rememberData();

        Notification::make()
            ->success()
            ->title('تم حفظ الإعدادات')
            ->send();
    }

    public function getTitle(): string|Htmlable
    {
        return static::$title ?? 'إعدادات الموقع';
    }
}
