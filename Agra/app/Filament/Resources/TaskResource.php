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
                Forms\Components\TextInput::make('TaskName')->label('Task Name'),
                Forms\Components\Select::make('lesson_id')
                    ->relationship('lesson', 'LessonName')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Textarea::make('Description')->label('Description'),
                Forms\Components\Textarea::make('TaskCodeTemplate')->label('Code Template'),
                Forms\Components\Textarea::make('TaskAnswerKeys')->label('Answer Keys'),
                Forms\Components\TextInput::make('TaskMaxScore')->label('Max Score')->numeric(),
                Forms\Components\TextInput::make('TaskMaxTime')->label('Max Time')->numeric(),
                Forms\Components\Select::make('TaskDifficulty')->label('Difficulty')
                    ->options([
                        'Easy' => 'Easy',
                        'Medium' => 'Medium',
                        'Hard' => 'Hard',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
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
            'create' => Pages\CreateTask::route('tasks/create'),
            'tasks' => Pages\ListTasks::route('/{record}'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('lesson_id', request('record'));
    }
}
