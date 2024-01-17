<?php

namespace App\Filament\Resources\AdsAttributeResource\Pages;

use App\Filament\Resources\AdsAttributeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAdsAttribute extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;

    protected static string $resource = AdsAttributeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
