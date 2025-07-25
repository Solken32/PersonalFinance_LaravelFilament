<?php

namespace App\Filament\Resources\PresupuestoResource\Pages;

use App\Filament\Resources\PresupuestoResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreatePresupuesto extends CreateRecord
{
    protected static string $resource = PresupuestoResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return null;
    }

    protected function afterCreate()
    {
        Notification::make()
            ->title('Presupuesto creado')
            ->body('El presupuesto ha sido creado exitosamente')
            ->success()
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()
                ->label('Registrar')
                ->color('success'),

            //$this->getCreateAnotherFormAction()
            //    ->label("Guardar y crear otro"),

            $this->getCancelFormAction()
                ->color('danger')
                ->label('Cancelar'),
        ];
    }
}
