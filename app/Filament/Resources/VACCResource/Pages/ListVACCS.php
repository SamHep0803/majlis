<?php

namespace App\Filament\Resources\VACCResource\Pages;

use App\Filament\Resources\VACCResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVACCS extends ListRecords
{
    protected static string $resource = VACCResource::class;

    protected static ?string $title = 'vACCs';

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
