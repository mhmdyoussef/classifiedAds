<?php

namespace App\Filament\Resources\AdsTrendResource\Pages;

use App\Filament\Resources\AdsTrendResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdsTrends extends ListRecords
{
    protected static string $resource = AdsTrendResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
