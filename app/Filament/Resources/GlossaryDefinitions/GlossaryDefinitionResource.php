<?php

namespace App\Filament\Resources\GlossaryDefinitions;

use App\Filament\Resources\GlossaryDefinitions\Pages\CreateGlossaryDefinition;
use App\Filament\Resources\GlossaryDefinitions\Pages\EditGlossaryDefinition;
use App\Filament\Resources\GlossaryDefinitions\Pages\ListGlossaryDefinitions;
use App\Filament\Resources\GlossaryDefinitions\Schemas\GlossaryDefinitionForm;
use App\Filament\Resources\GlossaryDefinitions\Tables\GlossaryDefinitionsTable;
use App\Models\GlossaryDefinition;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;

class GlossaryDefinitionResource extends Resource
{
    protected static ?string $model = GlossaryDefinition::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'description';

    public static function form(Schema $schema): Schema
{
    return $schema->components([
        Select::make('glossary_term_id')
            ->relationship('term', 'name')
            ->required()
            ->searchable(),
        Textarea::make('description')
            ->required()
            ->rows(4)
            ->columnSpanFull(),
        TextInput::make('unlocks_at_order')
            ->numeric()
            ->default(1)
            ->required()
            ->hint('Show this definition after the user has watched entry #X'),
    ]);
}

    public static function table(Table $table): Table
    {
        return GlossaryDefinitionsTable::configure($table);
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
            'index' => ListGlossaryDefinitions::route('/'),
            'create' => CreateGlossaryDefinition::route('/create'),
            'edit' => EditGlossaryDefinition::route('/{record}/edit'),
        ];
    }
}
