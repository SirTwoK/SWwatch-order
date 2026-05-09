<?php

namespace App\Filament\Resources\GlossaryDefinitions\Pages;

use App\Filament\Resources\GlossaryDefinitions\GlossaryDefinitionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGlossaryDefinition extends EditRecord
{
    protected static string $resource = GlossaryDefinitionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
