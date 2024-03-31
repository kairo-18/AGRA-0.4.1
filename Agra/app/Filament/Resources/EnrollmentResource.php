<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EnrollmentResource\Pages;
use App\Models\Enrollment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class EnrollmentResource extends Resource
{
    protected static ?string $model = Enrollment::class;
    protected static ?string $navigationGroup = 'Section Handling';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $user = Auth::user();

        if($user->hasRole(['admin', 'teacher'])) {
            return $form
                ->schema([
                    Forms\Components\Select::make('user_id')
                        ->relationship('user', 'name', function (Builder $query) {
                            $query->whereHas('roles', function ($query) {
                                $query->where('name', 'student');
                            });
                        }),
                    Forms\Components\Select::make('course_id')
                        ->relationship('course', 'CourseName', function (Builder $query) {
                            $query->whereNotIn('author', ['AGRA']);
                        }),
                ]);
        }

        return $form
            ->schema([
        Forms\Components\Select::make('user_id')
            ->relationship('user', 'name', function (Builder $query) {
                $query->whereHas('roles', function ($query) {
                    $query->where('name', 'student');
                });
            }),
        Forms\Components\Select::make('course_id')
            ->relationship('course', 'CourseName'),
        Forms\Components\Select::make('section_id')
            ->relationship('section', 'SectionCode'),
            ]);


    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('course.CourseName')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('section.SectionCode')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListEnrollments::route('/'),
            'create' => Pages\CreateEnrollment::route('/create'),
            'edit' => Pages\EditEnrollment::route('/{record}/edit'),
        ];
    }
}
