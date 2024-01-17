<?php

namespace App\Filament\Resources\AdsCommentResource\Pages;

use App\Filament\Resources\AdsCommentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAdsComment extends ViewRecord
{
    protected static string $resource = AdsCommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
