<?php

namespace App\Filament\Resources\WatchEntries\Pages;

use App\Filament\Resources\WatchEntries\WatchEntryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWatchEntries extends ListRecords
{
    protected static string $resource = WatchEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
