<?php

namespace App\Filament\Resources\AdsCategoryResource\Pages;

use App\Filament\Resources\AdsCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAdsCategory extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = AdsCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
