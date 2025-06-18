<?php

namespace App\Filament\Resources\CategoriaResource\Pages;

use App\Filament\Resources\CategoriaResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditCategoria extends EditRecord
{
    protected static string $resource = CategoriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->successNotification(
                Notification::make()
                    ->title("Categoría eliminada")
                    ->body("Categoría eliminada exitosamente")
                    ->success()
            ),
        ];
    }

    // cuando se edite redireccione al index
    protected function getRedirectUrl(): string 
    {
        return $this->getResource()::getUrl("index");
    }

    // para que no salga la notificacion predeterminada
    protected function getSavedNotification(): ?Notification
    {
        return null;
    }

    // notificacion de actualizacion personalizada
    protected function afterSave()
    {
        Notification::make()
            ->title("Categoría actualizada")
            ->body("Categoría actualizada exitosamente")
            ->success()
            ->send();
    }

    
}
