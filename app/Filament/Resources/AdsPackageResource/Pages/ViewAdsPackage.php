<?php

namespace App\Filament\Resources\AdsPackageResource\Pages;

use App\Filament\Resources\AdsPackageResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAdsPackage extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;

    protected static string $resource = AdsPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
