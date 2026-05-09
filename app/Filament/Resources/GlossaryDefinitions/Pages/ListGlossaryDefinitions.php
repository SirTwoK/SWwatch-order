<?php

namespace App\Filament\Resources\GlossaryDefinitions\Pages;

use App\Filament\Resources\GlossaryDefinitions\GlossaryDefinitionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGlossaryDefinitions extends ListRecords
{
    protected static string $resource = GlossaryDefinitionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
