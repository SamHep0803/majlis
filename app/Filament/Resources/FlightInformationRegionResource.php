<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FlightInformationRegionResource\Pages;
use App\Models\FlightInformationRegion;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class FlightInformationRegionResource extends Resource
{
    protected static ?string $model = FlightInformationRegion::class;

    protected static ?string $navigationGroup = 'Admin';

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('identifier')
                    ->maxLength(4)
                    ->unique()
                    ->required(),
                TextInput::make('name')
                    ->maxLength(255)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('identifier')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('vacc.codeName')
                    ->label('vACC'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFlightInformationRegions::route('/'),
            'create' => Pages\CreateFlightInformationRegion::route('/create'),
            'edit' => Pages\EditFlightInformationRegion::route('/{record}/edit'),
        ];
    }
}
