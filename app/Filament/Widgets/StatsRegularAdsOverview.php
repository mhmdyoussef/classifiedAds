<?php

namespace App\Filament\Widgets;

use App\Models\Ads;
use App\Models\AdsComment;
use App\Models\AdsCommercial;
use App\Models\AdsTrend;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsRegularAdsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Regulars', Ads::query()->count())
                ->color('success'),
            Stat::make('Total Trends', AdsTrend::query()->count())
                ->color('success'),
            Stat::make('Total Commercial', AdsCommercial::query()->count())
                ->color('success'),
        ];
    }
}
