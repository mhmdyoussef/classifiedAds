<?php

namespace App\Filament\Resources\AdsAttributeResource\Pages;

use App\Filament\Resources\AdsAttributeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAdsAttribute extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = AdsAttributeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
