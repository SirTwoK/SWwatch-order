<?php

namespace App\Filament\Resources\WatchEntries\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class WatchEntryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('order')
                    ->required()
                    ->numeric(),
                TextInput::make('title')
                    ->required(),
                TextInput::make('type')
                    ->required(),
                TextInput::make('series_name')
                    ->default(null),
                TextInput::make('season')
                    ->numeric()
                    ->default(null),
                TextInput::make('episode')
                    ->numeric()
                    ->default(null),
                TextInput::make('era')
                    ->required(),
                TextInput::make('era_label')
                    ->required(),
                TextInput::make('timeline')
                    ->required(),
                TextInput::make('duration_minutes')
                    ->required()
                    ->numeric(),
                TextInput::make('recommendation')
                    ->required(),
                TextInput::make('thumbnail_color')
                    ->required()
                    ->default('#1a2030'),
                TextInput::make('thumbnail_url')
                    ->url()
                    ->default(null),
                TextInput::make('thumbnail_position')
                    ->required()
                    ->default('center'),
                Textarea::make('synopsis')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('before_watch')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('after_watch')
                    ->default(null)
                    ->columnSpanFull(),
                Toggle::make('watched')
                    ->required(),
            ]);
    }
}
