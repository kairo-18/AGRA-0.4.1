<?php

namespace App\Filament\Resources\SectionResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class TaskScoresRelationManager extends RelationManager
{
    protected static string $relationship = 'scores';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('score')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('score')
            ->columns([
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('task.TaskName'),
                Tables\Columns\TextColumn::make('score'),
                Tables\Columns\TextColumn::make('MaxScore'),
                Tables\Columns\TextColumn::make('Percentage'),
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
            ])
            ->modifyQueryUsing(function (Builder $query) {
                // Subquery to get the latest attempt (maximum created_at) for each user and task combination
                //Let it be known i spent 3 hours making chatgpt write this shit
                $subQuery = DB::table('scores as ts')
                    ->select(DB::raw('MAX(ts.id) as latest_id'))
                    ->whereColumn('ts.user_id', 'scores.user_id')
                    ->whereColumn('ts.task_id', 'scores.task_id')
                    ->groupBy('ts.user_id', 'ts.task_id');

                // Filter the main query to only include the latest attempts
                $query->whereIn('id', $subQuery);
            });
    }


}
