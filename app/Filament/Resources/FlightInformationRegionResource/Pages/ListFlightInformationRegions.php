<?php

namespace App\Filament\Resources\FlightInformationRegionResource\Pages;

use App\Filament\Resources\FlightInformationRegionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFlightInformationRegions extends ListRecords
{
  protected static string $resource = FlightInformationRegionResource::class;

  protected function getActions(): array
  {
    return [
      Actions\CreateAction::make()
        ->label("New Flight Information Region"),
    ];
  }
}
