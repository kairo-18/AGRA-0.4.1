<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScoreResource\Pages;
use App\Filament\Resources\ScoreResource\RelationManagers;
use App\Models\Score;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class ScoreResource extends Resource
{
    protected static ?string $model = Score::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('task.TaskName'),
                Tables\Columns\TextColumn::make('section.SectionCode'),
                Tables\Columns\TextColumn::make('score'),
                Tables\Columns\TextColumn::make('MaxScore'),
                Tables\Columns\TextColumn::make('Percentage'),
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
            'index' => Pages\ListScores::route('/'),
            'create' => Pages\CreateScore::route('/create'),
            'edit' => Pages\EditScore::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        // Subquery to get the latest attempt (maximum created_at) for each user and task combination
        $subQuery = DB::table('scores as s')
            ->select(DB::raw('MAX(s.id) as latest_id'))
            ->whereColumn('s.user_id', 'scores.user_id')
            ->whereColumn('s.task_id', 'scores.task_id')
            ->groupBy('s.user_id', 's.task_id');

        return parent::getEloquentQuery()
            ->whereIn('id', $subQuery) // Only include the records from the latest attempts
            ->orderBy('created_at', 'desc'); // Order by latest attempt
    }
}
