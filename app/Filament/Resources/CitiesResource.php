<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CitiesResource\Pages;
use App\Filament\Resources\CitiesResource\RelationManagers;
use App\Models\Cities;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CitiesResource extends Resource
{
    protected static ?string $model = Cities::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('name')
                    ->helperText('Gunakan nama yang tepat')
                    ->required()
                    ->maxLength(255),

                Forms\Components\FileUpload::make('photo')
                    ->image()
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                Tables\Columns\ImageColumn::make('photo')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListCities::route('/'),
            'create' => Pages\CreateCities::route('/create'),
            'edit' => Pages\EditCities::route('/{record}/edit'),
        ];
    }
}
