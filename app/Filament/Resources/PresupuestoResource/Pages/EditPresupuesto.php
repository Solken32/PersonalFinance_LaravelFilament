<?php

namespace App\Filament\Resources\PresupuestoResource\Pages;

use App\Filament\Resources\PresupuestoResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditPresupuesto extends EditRecord
{
    protected static string $resource = PresupuestoResource::class;

    protected function getRedirectUrl(): ?string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return null;
    }

    protected function afterSave(): void
    {
        Notification::make()
            ->title('Presupuesto actualizado')
            ->body('El presupuesto ha sido actualizado exitosamente')
            ->success()
            ->send();
    }
    
}
