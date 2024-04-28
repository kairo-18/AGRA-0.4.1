<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Request;
class TaskResource extends Resource
{
    protected static ?string $model = Task::class;
    protected static ?string $slug = 'tasks/';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Course Management';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';



    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Forms\Components\Select::make('lesson_id')
                ->relationship('lesson', 'LessonName')
                ->searchable()
                ->preload()
                ,
                Forms\Components\Select::make('course_id')
                ->relationship('course', 'CourseName')
                ->searchable()
                ->preload(),
                Forms\Components\TextInput::make('TaskName')->label('Task Name'),
                Forms\Components\TextInput::make('Description')->label('Task Description'),
                Forms\Components\TextInput::make('TaskMaxScore')->label('Task Max Score')->numeric(),
                Forms\Components\TextInput::make('TaskMaxTime')->label('Task Max Time')->numeric(),
                Forms\Components\Select::make('TaskDifficulty')
                    ->options([
                        "Beginner" => "Beginner",
                        "Easy" => "Easy",
                        "Intermediate" => "Intermediate"
                    ])
                    ->label('Task Difficulty'),
                Forms\Components\DateTimePicker::make('DateGiven'),
                Forms\Components\DateTimePicker::make('Deadline'),

                Forms\Components\Textarea::make('TaskCodeTemplate'),

                Forms\Components\Textarea::make('TaskAnswerKeys')->default(1),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('lesson.id')->label('Lesson ID'),
                Tables\Columns\TextColumn::make('TaskName')->label('Task Name'),
                Tables\Columns\TextColumn::make('Description')->label('Description'),
                Tables\Columns\TextColumn::make('TaskMaxScore')->label('Max Score'),
                Tables\Columns\TextColumn::make('TaskMaxTime')->label('Max Time'),
                Tables\Columns\TextColumn::make('TaskDifficulty')->label('Difficulty'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
            RelationManagers\InstructionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'tasks' => Pages\ListTasks::route('/{record}'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // Check if the request is for the 'edit' page
        if (Request::is('*/*/edit')) {
            return $query;
        }

        // Check if there is an ID in the URL
        if (request()->route('record')) {
            // Apply the lesson ID filter
            $query->where('lesson_id', request()->route('record'));
        }

        return $query;
    }
}
