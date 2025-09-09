<?php

namespace App\Filament\Resources\SimpleProducts\Pages;

use App\Filament\Resources\SimpleProducts\SimpleProductResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSimpleProduct extends EditRecord
{
    protected static string $resource = SimpleProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
