<?php

namespace App\Filament\Resources\AttendeeResource\Pages;

use App\Filament\Resources\AttendeeResource;
use App\Filament\Resources\AttendeeResource\Widgets\AttendeesStatsWidget;
use App\Filament\Resources\AttendeResource\Widgets\AttendeesChartWidget;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;

class ListAttendees extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = AttendeeResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            AttendeesStatsWidget::class,
            AttendeesChartWidget::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
