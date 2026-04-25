<?php

namespace App\Filament\Resources\SectionContents;

use App\Filament\Resources\SectionContents\Pages\CreateSectionContent;
use App\Filament\Resources\SectionContents\Pages\EditSectionContent;
use App\Filament\Resources\SectionContents\Pages\ListSectionContents;
use App\Filament\Resources\SectionContents\RelationManagers\TranslationsRelationManager;
use App\Models\SectionContent;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SectionContentResource extends Resource
{
    protected static ?string $model = SectionContent::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static string|\UnitEnum|null $navigationGroup = 'Content';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('section_id')
                ->label('Section')
                ->relationship('section', 'name')
                ->searchable()
                ->preload()
                ->required(),

            Select::make('kind')
                ->options([
                    'section_heading' => 'Section Heading',
                    'rich_text' => 'Rich Text',
                    'faq_item' => 'FAQ Item',
                    'content' => 'Generic Content',
                ])
                ->default('content')
                ->required(),

            TextInput::make('key')
                ->label('Internal Key')
                ->helperText('Optional admin key, for example header-body or faq-item-1.'),

            TextInput::make('title')
                ->helperText('Default title. Use translations for localized versions.'),

            Textarea::make('content')
                ->rows(6)
                ->helperText('Default content. Use translations for localized versions.'),

            FileUpload::make('image')
                ->disk('public')
                ->directory('images')
                ->image()
                ->visibility('public'),

            KeyValue::make('extra')
                ->keyLabel('Key')
                ->valueLabel('Value'),

            TextInput::make('order')
                ->numeric()
                ->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('section.name')
                    ->label('Section')
                    ->searchable(),
                TextColumn::make('kind')->badge(),
                TextColumn::make('key')->toggleable(),
                TextColumn::make('translated_title')
                    ->label('Title')
                    ->limit(30),
                TextColumn::make('order')->sortable(),
            ])
            ->defaultSort('order')
            ->recordActions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            TranslationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSectionContents::route('/'),
            'create' => CreateSectionContent::route('/create'),
            'edit' => EditSectionContent::route('/{record}/edit'),
        ];
    }

    public static function getPluralModelLabel(): string
    {
        return 'Section Contents';
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with([
                'section',
                'translations' => function ($query) {
                    $query->where('locale', app()->getLocale());
                },
            ]);
    }
}
