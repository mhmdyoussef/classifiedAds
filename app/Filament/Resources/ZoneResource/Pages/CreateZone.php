<?php

namespace App\Filament\Resources\ZoneResource\Pages;

use App\Filament\Resources\ZoneResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateZone extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = ZoneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
