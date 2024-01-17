<?php

namespace App\Filament\Resources\AdsTrendResource\Pages;

use App\Filament\Resources\AdsTrendResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAdsTrend extends ViewRecord
{
    protected static string $resource = AdsTrendResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
