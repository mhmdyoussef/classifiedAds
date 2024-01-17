<?php

namespace App\Filament\Resources\AdsPackageResource\Pages;

use App\Filament\Resources\AdsPackageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAdsPackage extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = AdsPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
