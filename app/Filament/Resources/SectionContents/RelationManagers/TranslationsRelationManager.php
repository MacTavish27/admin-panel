<?php

namespace App\Filament\Resources\SectionContents\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TranslationsRelationManager extends RelationManager
{
    protected static string $relationship = 'translations';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('locale')
                    ->options([
                        'en' => 'English',
                        'ru' => 'Russian',
                        'uz' => 'Uzbek',
                        'kk' => 'Qoraqalpoq',
                    ])
                    ->required(),

                RichEditor::make('title')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'bulletList',
                        'orderedList',
                        'link',
                        'redo',
                        'undo',
                    ])
                    ->maxLength(255),

                RichEditor::make('content')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'bulletList',
                        'orderedList',
                        'link',
                        'redo',
                        'undo',
                    ]),

                KeyValue::make('extra')
                    ->keyLabel('Key')
                    ->valueLabel('Value')
                    ->helperText('Optional translated metadata'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('locale')->badge(),
                TextColumn::make('title')
                    ->searchable()
                    ->limit(40),
                TextColumn::make('content')->limit(60),
            ])
            ->headerActions([
                CreateAction::make()->label('Create a new translation'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
