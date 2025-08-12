<?php

namespace App\Filament\App\Resources\ProcurementResource\Pages;

use App\Filament\App\Resources\ProcurementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProcurement extends EditRecord
{
    protected static string $resource = ProcurementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
