<?php

namespace App\Filament\Resources\AdsCategoryResource\Pages;

use App\Filament\Resources\AdsCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAdsCategory extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;
    protected static string $resource = AdsCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
