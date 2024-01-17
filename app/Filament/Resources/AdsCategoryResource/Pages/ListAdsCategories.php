<?php

namespace App\Filament\Resources\AdsCategoryResource\Pages;

use App\Filament\Resources\AdsCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdsCategories extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = AdsCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
