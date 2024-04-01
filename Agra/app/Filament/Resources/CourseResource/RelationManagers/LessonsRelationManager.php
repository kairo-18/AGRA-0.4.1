<?php

namespace App\Filament\Resources\CourseResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LessonsRelationManager extends RelationManager
{
    protected static string $relationship = 'lessons';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('LessonName')->required(),
                Forms\Components\TextInput::make('LessonDescription')->required()->minLength(10)->maxLength(255),
                Forms\Components\Section::make("Category")
                    ->schema([
                        Forms\Components\Select::make('LessonCategory')
                            ->options([
                                'Java' => 'Java',
                                'C#' => 'C#',
                            ])
                            ->required(),
                    ]),
                Forms\Components\Section::make("Lesson Material")
                    ->schema([
                        Forms\Components\FileUpload::make('LessonFile')
                        ->columns(1)
                        ->preserveFilenames()
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {

        return $table
            ->recordTitleAttribute('LessonName')
            ->columns([
                Tables\Columns\TextColumn::make('LessonName'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('Tasks')
                    ->url(function ($record) {
                        return url('admin/tasks/' . $record->id);
                    })
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
