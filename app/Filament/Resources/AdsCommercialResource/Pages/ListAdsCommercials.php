<?php

namespace App\Filament\Resources\AdsCommercialResource\Pages;

use App\Filament\Resources\AdsCommercialResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdsCommercials extends ListRecords
{
    protected static string $resource = AdsCommercialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
