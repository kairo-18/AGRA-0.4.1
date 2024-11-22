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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use PHPUnit\Util\Filter;

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
                Forms\Components\Select::make('Course')
                    ->relationship('course', 'CourseName')
                    ->required(),
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
                Forms\Components\Textarea::make('links')->label('YT Links'),
                Forms\Components\Textarea::make('webLinks')->label('Web Links'),
                Forms\Components\Select::make('Categories')
                    ->relationship('categories', 'name')
                    ->multiple()
                    ->preload(),

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
                SelectFilter::make('course_id')
                    ->label('Course Name')
                    ->relationship('course', 'CourseName', fn (Builder $query) => $query->where('author', '!=', 'AGRA'))
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
        $user = Auth::user();
        $query = parent::getEloquentQuery();

        // Check if the request is for the 'edit' page
        if (Request::is('*/edit')) {
            return $query;
        }

        // Check if the user has the 'admin' role
        if ($user->hasRole('admin')) {
            // Modify the query to filter out lessons where the related course's author is 'AGRA'
            return $query->whereHas('course', function (Builder $query) {
                $query->where('author', '!=', 'AGRA');
            });
        }

        return $query;
    }

}
