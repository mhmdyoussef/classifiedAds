<?php

namespace App\Filament\Resources\AdsCommentResource\Pages;

use App\Filament\Resources\AdsCommentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdsComments extends ListRecords
{
    protected static string $resource = AdsCommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
