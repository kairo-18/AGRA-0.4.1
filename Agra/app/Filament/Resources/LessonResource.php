<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LessonResource\Pages;
use App\Filament\Resources\LessonResource\RelationManagers;
use App\Models\Lesson;
use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static ?string $slug = 'lessons/';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Course Management';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 //
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

                    Forms\Components\Select::make('course_id')
                        ->relationship('course', 'CourseName')
                        ->searchable()
                        ->required(),
                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('LessonName'),
                Tables\Columns\TextColumn::make('LessonCategory'),
                Tables\Columns\TextColumn::make('course.CourseName')
                ->searchable()
                ->sortable()
                ,
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Tasks')->url(fn ($record): string => url('admin/tasks/'.$record->id)),
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
            RelationManagers\TasksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLessons::route('/'),
            'create' => Pages\CreateLesson::route('lessons/create'),
            'lessons' => Pages\ListLessons::route('/{record}'),
            'edit' => Pages\EditLesson::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('course_id', request('record'));
    }
}
