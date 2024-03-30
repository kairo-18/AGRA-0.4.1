<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers;
use App\Models\Course;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Course Management';


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {

        $user = auth()->user();

        if($user->hasRole('admin')){
            return $form
                ->schema([
                    //
                    Forms\Components\TextInput::make('CourseName')->required(),
                    Forms\Components\TextInput::make('CourseDescription')->required(),
                    Forms\Components\Section::make("Category")
                        ->schema([
                            Forms\Components\Select::make('category_id')
                                ->relationship('category', 'name')
                                ->required(),
                        ]),

                    Forms\Components\Select::make('Author')
                        ->options(['STI' => 'STI'])
                        ->required(),


                ]);
        } else if($user->hasRole('dev')){
            return $form
                ->schema([
                    //
                    Forms\Components\TextInput::make('CourseName')->required(),
                    Forms\Components\TextInput::make('CourseDescription')->required(),
                    Forms\Components\Section::make("Category")
                        ->schema([
                            Forms\Components\Select::make('category_id')
                                ->relationship('category', 'name')
                                ->required(),
                        ]),

                    Forms\Components\Select::make('Author')
                        ->options(['AGRA' => 'AGRA'])
                        ->required(),

                ]);
        }


        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('CourseName')->disabled(),
                Forms\Components\TextInput::make('CourseDescription')->disabled(),
                Forms\Components\Section::make("Category")
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->disabled(),
                    ])

            ]);


    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('CourseName'),
                Tables\Columns\TextColumn::make('category.name'),
                Tables\Columns\TextColumn::make('author'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                //Tables\Actions\Action::make('Lessons')->url(fn ($record): string => url('admin/lessons/'.$record->id)),
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
            RelationManagers\LessonsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
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

        if($user->hasRole('admin')) {
            return parent::getEloquentQuery()->whereNotIn('author', ['AGRA']);
        }

        return $query;
    }
}
