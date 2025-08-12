<?php

namespace App\Filament\App\Resources\ProcurementResource\Pages;

use App\Filament\App\Resources\ProcurementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProcurements extends ListRecords
{
    protected static string $resource = ProcurementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
