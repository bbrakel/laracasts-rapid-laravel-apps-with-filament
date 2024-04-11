<?php

namespace App\Filament\Resources\AttendeeResource\Widgets;

use App\Models\Attendee;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AttendeesStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Attendees Count', Attendee::count())
                ->description('Total number of attendees')
                ->descriptionIcon('heroicon-o-user-group')
                ->color('success')
                ->chart([1, 2, 3, 4, 5, 4, 1, 1]),
            Stat::make('Total Revenue', (Attendee::sum('ticket_cost') / 100)),
        ];
    }
}
