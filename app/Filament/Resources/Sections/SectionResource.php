<?php

namespace App\Filament\Resources\Sections;

use App\Filament\Resources\Sections\Pages\CreateSection;
use App\Filament\Resources\Sections\Pages\EditSection;
use App\Filament\Resources\Sections\Pages\ListSections;
use App\Filament\Resources\Sections\Schemas\SectionForm;
use App\Filament\Resources\Sections\Tables\SectionsTable;
use App\Models\Section;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\Sections\RelationManagers\ItemsRelationManager;
use Filament\Forms\Components\Select;

class SectionResource extends Resource
{
    protected static ?string $model = Section::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('type')
                ->required()
                ->options([
                    'header' => 'Header',
                    'intro' => 'Intro',
                    'programme_vision' => 'Programme Vision',
                    'research' => 'Research',
                    'programme_outcomes' => 'Programme Outcomes',
                    'apply' => 'Apply',
                    'team' => 'Team',
                    'mentors' => 'Mentors',
                    'faq' => 'FAQ',
                    'about' => 'About',
                    'footer' => 'Footer',
                ]),

            TextInput::make('title'),

            Textarea::make('content')
                ->rows(5),

            FileUpload::make('image')
                ->disk('public')
                ->directory('images')
                ->image()
                ->visibility('public'),

            TextInput::make('order')
                ->numeric()
                ->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return SectionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSections::route('/'),
            'create' => CreateSection::route('/create'),
            'edit' => EditSection::route('/{record}/edit'),
        ];
    }
}
