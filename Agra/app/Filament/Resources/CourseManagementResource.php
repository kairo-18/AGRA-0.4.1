<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseManagementResource\Pages;
use App\Filament\Resources\CourseManagementResource\RelationManagers;
use App\Models\Section;
use App\Models\SectionManagement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CourseManagementResource extends Resource
{
    protected static ?string $model = SectionManagement::class;
    protected static ?string $navigationGroup = 'Section Handling';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name', function (Builder $query) {
                        $query->whereHas('roles', function ($query) {
                            $query->where('name', 'teacher');
                        });
                    }),
                Forms\Components\Select::make('section_id')
                    ->relationship('section', 'SectionCode')
                ,


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID'),
                Tables\Columns\TextColumn::make('section.SectionCode')
                    ->label('Section'),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User ID (Teacher)'),
                // Add more table columns as needed based on the attributes of the section_management model
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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourseManagement::route('/'),
            'create' => Pages\CreateCourseManagement::route('/create'),
            'edit' => Pages\EditCourseManagement::route('/{record}/edit'),
        ];
    }

}
