<?php

namespace App\Filament\Resources\CustomPageResource\Pages;

use App\Filament\Resources\CustomPageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomPage extends EditRecord
{
    protected static string $resource = CustomPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
