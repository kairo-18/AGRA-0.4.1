<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionResource\Pages;
use App\Filament\Resources\SectionResource\RelationManagers;
use App\Models\Section;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SectionResource extends Resource
{
    protected static ?string $model = Section::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Section Handling';

    public static function form(Form $form): Form
    {

        $user = auth()->user();

        if($user->hasRole('admin')){
            return $form
                ->schema([
                    Forms\Components\TextInput::make('SectionCode')
                        ->required()
                        ->maxLength(255)
                    ,
                ]);
        }
        return $form
            ->schema([
                Forms\Components\TextInput::make('SectionCode')
                    ->required()
                    ->maxLength(255)
                ->disabledOn('edit')
                ,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('SectionCode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id'),
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
            RelationManagers\UsersRelationManager::class,
            RelationManagers\CoursesRelationManager::class,
            RelationManagers\EnrollmentsRelationManager::class,
            RelationManagers\TaskScoresRelationManager::class,
            RelationManagers\TaskStatusesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSections::route('/'),
            'create' => Pages\CreateSection::route('/create'),
            'edit' => Pages\EditSection::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        // Check if the user is authenticated and has the role of 'admin'
        if ($user && $user->hasRole('admin')) {
            return parent::getEloquentQuery();
        }

        // For other users (e.g., teachers), filter based on the logged-in user's ID
        $loggedInUserId = $user->id;

        return parent::getEloquentQuery()->whereHas('teachers', function ($query) use ($loggedInUserId) {
            $query->where('user_id', $loggedInUserId);
        });
    }

}
