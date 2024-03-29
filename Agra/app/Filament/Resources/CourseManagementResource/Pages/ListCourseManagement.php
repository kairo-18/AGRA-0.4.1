<?php

namespace App\Filament\Resources\CourseManagementResource\Pages;

use App\Filament\Resources\CourseManagementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCourseManagement extends ListRecords
{
    protected static string $resource = CourseManagementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
