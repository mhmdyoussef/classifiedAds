<?php

namespace App\Filament\Resources\AdsPackageResource\Pages;

use App\Filament\Resources\AdsPackageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdsPackage extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = AdsPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
