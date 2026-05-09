<?php

namespace App\Filament\Resources\GlossaryDefinitions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class GlossaryDefinitionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('glossary_term_id')
                    ->required()
                    ->numeric(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('unlocks_at_order')
                    ->required()
                    ->numeric()
                    ->default(1),
            ]);
    }
}
