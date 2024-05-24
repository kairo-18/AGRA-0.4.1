<?php

namespace App\Filament\Resources\OutputResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OutputRelationManager extends RelationManager
{
    protected static string $relationship = 'output';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('template')
                    ->required(),
                Forms\Components\Textarea::make('code')
                    ->required(),
                Forms\Components\Textarea::make('methodName')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('template')
            ->columns([
                Tables\Columns\TextColumn::make('template'),
                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\TextColumn::make('methodName'),
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
