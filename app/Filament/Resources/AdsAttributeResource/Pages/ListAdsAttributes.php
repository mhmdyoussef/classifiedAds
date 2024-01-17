<?php

namespace App\Filament\Resources\AdsAttributeResource\Pages;

use App\Filament\Resources\AdsAttributeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdsAttributes extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = AdsAttributeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
