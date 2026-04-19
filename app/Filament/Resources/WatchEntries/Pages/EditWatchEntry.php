<?php

namespace App\Filament\Resources\WatchEntries\Pages;

use App\Filament\Resources\WatchEntries\WatchEntryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditWatchEntry extends EditRecord
{
    protected static string $resource = WatchEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
