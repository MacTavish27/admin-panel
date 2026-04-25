<?php

namespace App\Filament\Resources\Sections;

use App\Filament\Resources\Sections\Pages\CreateSection;
use App\Filament\Resources\Sections\Pages\EditSection;
use App\Filament\Resources\Sections\Pages\ListSections;
use App\Filament\Resources\Sections\Tables\SectionsTable;
use App\Models\Section;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SectionResource extends Resource
{
    protected static ?string $model = Section::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'Content';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')
                ->required()
                ->helperText('Admin label used inside the panel only.'),

            Select::make('type')
                ->required()
                ->helperText('Select where this section is used on the public page.')
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSections::route('/'),
            'create' => CreateSection::route('/create'),
            'edit' => EditSection::route('/{record}/edit'),
        ];
    }

    public static function getPluralModelLabel(): string
    {
        return 'Sections';
    }
}
