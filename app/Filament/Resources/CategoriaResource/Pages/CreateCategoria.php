<?php

namespace App\Filament\Resources\CategoriaResource\Pages;

use App\Filament\Resources\CategoriaResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateCategoria extends CreateRecord
{
    protected static string $resource = CategoriaResource::class;

    // despues de crear redirigir al index
    protected function getRedirectUrl(): string 
    {
        return $this->getResource()::getUrl("index");
    }

    // para que no salga la notificacion predeterminada
    protected function getCreatedNotification(): ?Notification
    {
        return null;
    }

    // notificacion de insercion personalizado
    protected function afterCreate()
    {
        Notification::make()
            ->title("Categoría creada")
            ->body("La categoría ha sido creada exitosamente")
            ->success()
            ->send();

    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()
                ->label("Registrar")
                ->color("success"),
            
            //$this->getCreateAnotherFormAction()
            //    ->label("Guardar y crear otro"),

            $this->getCancelFormAction()
                ->color("danger")
                ->label("Cancelar"),

        ];
    }


}
