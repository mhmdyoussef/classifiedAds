<?php

namespace App\Filament\Resources\AdsCommercialResource\Pages;

use App\Filament\Resources\AdsCommercialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdsCommercial extends EditRecord
{
    protected static string $resource = AdsCommercialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
