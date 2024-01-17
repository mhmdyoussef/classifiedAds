<?php

namespace App\Filament\Resources\AdsCommercialResource\Pages;

use App\Filament\Resources\AdsCommercialResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAdsCommercial extends ViewRecord
{
    protected static string $resource = AdsCommercialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
