<?php

namespace App\Filament\Resources\FlightInformationRegionResource\RelationManagers;

use App\Enums\RoleKey;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserRelationManager extends RelationManager
{
  protected static string $relationship = 'users';

  protected static ?string $recordTitleAttribute = 'name';

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('name'),
        BadgeColumn::make('role.description')
          ->enum(RoleKey::cases()),
        Tables\Columns\TagsColumn::make('flightInformationRegions.identifier'),
      ])
      ->filters([
        //
      ])
      ->headerActions([
        Tables\Actions\AttachAction::make()
          ->label("Add User to FIR"),
      ])
      ->actions([
        Tables\Actions\DetachAction::make()
          ->label("Remove"),
      ])
      ->bulkActions([
        Tables\Actions\DetachBulkAction::make(),
      ]);
  }
}
