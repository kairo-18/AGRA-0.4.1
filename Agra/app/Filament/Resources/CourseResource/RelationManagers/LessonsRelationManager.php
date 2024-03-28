<?php

namespace App\Filament\Resources\CourseResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LessonsRelationManager extends RelationManager
{
    protected static string $relationship = 'lesson';

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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
