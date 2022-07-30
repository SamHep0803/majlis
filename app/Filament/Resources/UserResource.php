<?php

namespace App\Filament\Resources;

use App\Enums\RoleKey;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\FlightInformationRegion;
use App\Models\User;
use Auth;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
  protected static ?string $model = User::class;

  protected static ?string $navigationIcon = 'heroicon-o-collection';

  public static function form(Form $form): Form
  {
    $roles = collect(Auth::user()->getAssignableRoles())->transform(fn (RoleKey $roleKey) => $roleKey->value);
    return $form
      ->schema([
        Forms\Components\TextInput::make("id")
          ->label("ID")
          ->disabled()
          ->dehydrated(false)
          ->required(),
        Forms\Components\TextInput::make("name")
          ->disabled()
          ->dehydrated(false)
          ->required(),
        Forms\Components\Select::make("role_id")
          ->relationship("role", "description", fn (Builder $query) => $query->whereIn("key", $roles))
          ->required(),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make("id")
          ->label(__("ID"))
          ->searchable(),
        Tables\Columns\TextColumn::make("name")
          ->searchable(),
        BadgeColumn::make('role.description')
          ->enum(RoleKey::cases()),
        Tables\Columns\TagsColumn::make("flightInformationRegions.identifier")
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
    return [
      UserResource\RelationManagers\FlightInformationRegionsRelationManager::class
    ];
  }

  public static function getPages(): array
  {
    return [
      'index' => Pages\ListUsers::route('/'),
      'edit' => Pages\EditUser::route('/{record}/edit'),
    ];
  }
}