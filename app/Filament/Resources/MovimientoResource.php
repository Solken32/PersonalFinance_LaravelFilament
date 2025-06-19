<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MovimientoResource\Pages;
use App\Filament\Resources\MovimientoResource\RelationManagers;
use App\Models\Categoria;
use App\Models\Movimiento;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MovimientoResource extends Resource
{
    protected static ?string $model = Movimiento::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                Forms\Components\Select::make('user_id')
                    ->label('Usuario')
                    ->required()
                    ->options(User::all()->pluck('name','id'))
                    ->searchable(),

                Forms\Components\Select::make('categoria_id')
                    ->required()
                    ->label('Categoria')
                    ->options(Categoria::all()->pluck('nombre','id'))
                    ->searchable(),
                Forms\Components\Select::make('tipo')
                    ->required()
                    ->options([
                        'Gasto' => 'Gasto',
                        'Ingreso' => 'Ingreso',
                    ]),
                Forms\Components\TextInput::make('monto')
                    ->label('Monto')
                    ->required()
                    ->numeric(),

                Forms\Components\RichEditor::make('descripcion')
                    ->label('Descripción')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('foto')
                    ->label('Foto')
                    ->image()
                    ->disk("public")
                    ->directory('movimientos')
                    ->default(null),
                Forms\Components\DatePicker::make('fecha')
                    ->required(),
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

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Usuario')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('categoria.nombre')
                    ->label('Categoria')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipo')
                    ->label('Tipo')
                    ->sortable(),

                Tables\Columns\TextColumn::make('descripcion')
                    ->label('Descripción')
                    ->searchable()
                    ->html()
                    ->limit(50),

                Tables\Columns\TextColumn::make('monto')
                    ->label('Monto')
                    ->numeric(),

                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->width(100)
                    ->height(100),
                    
                Tables\Columns\TextColumn::make('fecha')
                    ->label('Fecha')
                    ->date()
                    ->sortable(),
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
                    ->label("Tipo"),
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
                            ->title("Movimiento eliminado")
                            ->body("Movimiento eliminado exitosamente")
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
            'index' => Pages\ListMovimientos::route('/'),
            'create' => Pages\CreateMovimiento::route('/create'),
            'edit' => Pages\EditMovimiento::route('/{record}/edit'),
        ];
    }
}
