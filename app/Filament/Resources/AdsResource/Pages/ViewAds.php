<?php

namespace App\Filament\Resources\AdsResource\Pages;

use App\Filament\Resources\AdsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAds extends ViewRecord
{
    protected static string $resource = AdsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
