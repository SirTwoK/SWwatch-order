<?php

namespace App\Filament\Resources\WatchEntries;

use App\Filament\Resources\WatchEntries\Pages\CreateWatchEntry;
use App\Filament\Resources\WatchEntries\Pages\EditWatchEntry;
use App\Filament\Resources\WatchEntries\Pages\ListWatchEntries;
use App\Filament\Resources\WatchEntries\Schemas\WatchEntryForm;
use App\Filament\Resources\WatchEntries\Tables\WatchEntriesTable;
use App\Models\WatchEntry;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;

class WatchEntryResource extends Resource
{
    protected static ?string $model = WatchEntry::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
{
    return $schema->components([
        TextInput::make('order')
            ->required()
            ->numeric(),
        TextInput::make('title')
            ->required(),
        Select::make('recommendation')
            ->options([
                'must'               => 'Must Watch',
                'highly_recommended' => 'Highly Recommended',
                'recommended'        => 'Recommended',
                'skip'               => 'Could Skip',
            ])
            ->required(),
        Textarea::make('synopsis')
            ->rows(3)
            ->columnSpanFull(),
        Textarea::make('before_watch')
            ->rows(5)
            ->hint('Use [[slug]] to highlight glossary terms. Example: [[ahsoka-tano]]')
            ->columnSpanFull(),
        Textarea::make('after_watch')
            ->rows(5)
            ->hint('Use [[slug]] to highlight glossary terms.')
            ->columnSpanFull(),
    ]);
}

    public static function table(Table $table): Table
    {
        return WatchEntriesTable::configure($table);
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
            'index' => ListWatchEntries::route('/'),
            'create' => CreateWatchEntry::route('/create'),
            'edit' => EditWatchEntry::route('/{record}/edit'),
        ];
    }
}
