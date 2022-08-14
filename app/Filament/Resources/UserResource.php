<?php

namespace App\Filament\Resources;

use App\Enums\RoleKey;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use App\Models\vACC;
use Auth;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'Admin';

    protected static ?string $navigationIcon = 'heroicon-o-user';

    private static function vACCOptions(Collection $vACCs)
    {
        return $vACCs->mapWithKeys(fn (vACC $vACC) => [$vACC->id => $vACC->codeName]);
    }

    public static function form(Form $form): Form
    {
        $roles = collect(Auth::user()->getAssignableRoles())->transform(fn (RoleKey $roleKey) => $roleKey->value);

        return $form
      ->schema([
          Forms\Components\TextInput::make('id')
            ->label('ID')
            ->disabled()
            ->dehydrated(false)
            ->required(),
          Forms\Components\TextInput::make('name')
            ->disabled()
            ->dehydrated(false)
            ->required(),
          Forms\Components\Select::make('role_id')
            ->relationship('role', 'description', fn (Builder $query) => $query->whereIn('key', $roles)),
          Select::make('vacc_id')
            ->label('vACC')
            ->relationship('vacc', 'name')
            ->options(self::vACCOptions(vACC::all())),
      ]);
    }

    public static function table(Table $table): Table
    {
        return $table
      ->columns([
          Tables\Columns\TextColumn::make('id')
            ->label(__('ID'))
            ->searchable(),
          Tables\Columns\TextColumn::make('name')
            ->searchable(),
          BadgeColumn::make('role.description')
            ->enum(RoleKey::cases()),
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
