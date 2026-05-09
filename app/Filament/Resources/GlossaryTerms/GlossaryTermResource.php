<?php

namespace App\Filament\Resources\GlossaryTerms;

use App\Filament\Resources\GlossaryTerms\Pages\CreateGlossaryTerm;
use App\Filament\Resources\GlossaryTerms\Pages\EditGlossaryTerm;
use App\Filament\Resources\GlossaryTerms\Pages\ListGlossaryTerms;
use App\Filament\Resources\GlossaryTerms\Schemas\GlossaryTermForm;
use App\Filament\Resources\GlossaryTerms\Tables\GlossaryTermsTable;
use App\Models\GlossaryTerm;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;

class GlossaryTermResource extends Resource
{
    protected static ?string $model = GlossaryTerm::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
{
    return $schema->components([
        TextInput::make('name')
            ->required()
            ->live(onBlur: true)
            ->afterStateUpdated(fn ($state, \Filament\Schemas\Components\Utilities\Set $set) =>
                $set('slug', str($state)->slug()->toString())
            ),
        TextInput::make('slug')
            ->required()
            ->unique(ignoreRecord: true)
            ->hint('Auto-generated from name — use this in [[slug]] markup'),
        Repeater::make('definitions')
            ->relationship()
            ->schema([
                Textarea::make('description')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),
                TextInput::make('unlocks_at_order')
                    ->numeric()
                    ->default(1)
                    ->required()
                    ->hint('Show this definition after the user has watched entry #X'),
            ])
            ->columnSpanFull(),
    ]);
}

    public static function table(Table $table): Table
    {
        return GlossaryTermsTable::configure($table);
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
            'index' => ListGlossaryTerms::route('/'),
            'create' => CreateGlossaryTerm::route('/create'),
            'edit' => EditGlossaryTerm::route('/{record}/edit'),
        ];
    }
}
