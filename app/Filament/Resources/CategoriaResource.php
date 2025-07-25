<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoriaResource\Pages;
use App\Filament\Resources\CategoriaResource\RelationManagers;
use App\Models\Categoria;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoriaResource extends Resource
{
    protected static ?string $model = Categoria::class;
    // cambiar icono
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make("Complete la Informacion")
                    ->schema([
                        Forms\Components\TextInput::make('nombre')
                            ->required()
                            ->label("Nombre de la categoria")
                            ->placeholder("Ejp: Alimentacion,Pasajes...")
                            ->maxLength(255),
                        Forms\Components\Select::make('tipo')
                            ->options([
                                "Gasto" => "Gasto",
                                "Ingreso" => "Ingreso"
                            ])
                            ->label("Tipo de movimiento")
                            ->required(),
                    ])
                    ->columns(2)
                    ->columnSpan(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("id")
                    ->sortable()
                    ->label("Item")
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('nombre')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tipo'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make("tipo")
                    ->options([
                        "Ingreso" => "Ingreso",
                        "Gasto" => "Gasto"
                    ])
                    ->placeholder("Filtrar por tipo")
                    ->label("Tipo")
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->button()
                    ->color("info"),

                Tables\Actions\DeleteAction::make()
                    ->button()
                    ->color("danger")
                    ->successNotification(
                        Notification::make()
                            ->title("Categoría eliminada")
                            ->body("Categoría eliminada exitosamente")
                            ->success()
                    ),

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
            'index' => Pages\ListCategorias::route('/'),
            'create' => Pages\CreateCategoria::route('/create'),
            'edit' => Pages\EditCategoria::route('/{record}/edit'),
        ];
    }
}
