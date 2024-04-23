<?php

namespace App\Filament\Pages;

use App\Models\Instruction;
use App\Models\Task;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;

class InstructionGeneratorPage extends Page implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.instruction-generator-page';

    protected static ?string $title = "Instruction Creation";


    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Instructions')
            ->query(Instruction::query())
            ->columns([
                Tables\Columns\TextColumn::make('task.TaskName'),
                Tables\Columns\TextColumn::make('instruction'),
                Tables\Columns\TextColumn::make('answer'),
                Tables\Columns\TextColumn::make('points'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver()
                    ->form([
                        Forms\Components\Select::make('task_id')
                            ->relationship('task', 'TaskName')
                            ->required()
                        ,
                        Forms\Components\TextInput::make('instruction')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('answer')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('points')
                            ->required()
                            ->numeric()
                            ->maxLength(255),
                        Forms\Components\Livewire::make("code-editor")
                    ]),
                Tables\Actions\DeleteAction::make(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('task_id')
                    ->label('Task')
                    ->options(Task::all()->pluck('TaskName', 'id'))
                    ->preload()
                    ->searchable()
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->slideOver()
                    ->model(Instruction::class)
                    ->form([
                        Forms\Components\Select::make('task_id')
                            ->relationship('task', 'TaskName')
                            ->required()
                        ,
                        Forms\Components\TextInput::make('instruction')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('answer')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('points')
                            ->required()
                            ->numeric()
                            ->maxLength(255),
                    ])
                ,
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
