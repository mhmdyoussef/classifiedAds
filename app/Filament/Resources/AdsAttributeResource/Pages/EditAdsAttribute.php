<?php

namespace App\Filament\Resources\AdsAttributeResource\Pages;

use App\Filament\Resources\AdsAttributeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdsAttribute extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = AdsAttributeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
