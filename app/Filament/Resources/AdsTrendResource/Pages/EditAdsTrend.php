<?php

namespace App\Filament\Resources\AdsTrendResource\Pages;

use App\Filament\Resources\AdsTrendResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdsTrend extends EditRecord
{
    protected static string $resource = AdsTrendResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
