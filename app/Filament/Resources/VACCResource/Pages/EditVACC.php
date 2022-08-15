<?php

namespace App\Filament\Resources\VACCResource\Pages;

use App\Filament\Resources\VACCResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVACC extends EditRecord
{
    protected static string $resource = VACCResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
