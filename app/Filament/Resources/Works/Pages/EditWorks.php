<?php

namespace App\Filament\Resources\Works\Pages;

use App\Filament\Resources\Works\WorksResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditWorks extends EditRecord
{
    protected static string $resource = WorksResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
