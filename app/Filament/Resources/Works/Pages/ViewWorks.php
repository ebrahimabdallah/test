<?php

namespace App\Filament\Resources\Works\Pages;

use App\Filament\Resources\Works\WorksResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewWorks extends ViewRecord
{
    protected static string $resource = WorksResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
