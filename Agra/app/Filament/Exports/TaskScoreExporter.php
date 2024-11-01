<?php

namespace App\Filament\Exports;

use App\Models\TaskScore;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class TaskScoreExporter extends Exporter
{
    protected static ?string $model = TaskScore::class;
    public static function getColumns(): array
    {
        return [
            //
            ExportColumn::make('user.name')->label('Student Name'),
            ExportColumn::make('task.TaskName')->label('Task'),
            ExportColumn::make('score'),
            ExportColumn::make('MaxScore'),
            ExportColumn::make('Percentage'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your task score export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
