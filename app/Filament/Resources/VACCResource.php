<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VACCResource\Pages;
use App\Models\vACC;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class VACCResource extends Resource
{
    protected static ?string $model = vACC::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = "Admin";

    /**
     *  Set all labels to correct values.
     */
    protected static ?string $slug = 'vaccs';

    protected static ?string $modelLabel = 'vACC';

    protected static ?string $pluralModelLabel = 'vACCs';

    protected static ?string $breadcrumb = 'vACCs';

    protected static ?string $navigationLabel = 'vACCs';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\BooleanColumn::make('isMENA')
                    ->label('MENA vACC?'),
                Tables\Columns\TagsColumn::make("flight_information_regions.identifierName")
                    ->label("Flight Information Regions")
            ])
            ->filters([
                Filter::make("isMENA")
                    ->query(fn (Builder $query): Builder => $query->where("isMENA", true))
                    ->toggle()
            ])
            ->actions([])
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
            'index' => Pages\ListVACCS::route('/'),
            'edit' => Pages\EditVACC::route('/{record}/edit'),
        ];
    }
}
