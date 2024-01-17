<?php

namespace App\Filament\Resources\AdsCommentResource\Pages;

use App\Filament\Resources\AdsCommentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdsComment extends EditRecord
{
    protected static string $resource = AdsCommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
        ];
    }
}
