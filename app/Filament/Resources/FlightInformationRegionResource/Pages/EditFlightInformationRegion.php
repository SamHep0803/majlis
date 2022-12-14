<?php

namespace App\Filament\Resources\FlightInformationRegionResource\Pages;

use App\Filament\Resources\FlightInformationRegionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFlightInformationRegion extends EditRecord
{
    protected static string $resource = FlightInformationRegionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
