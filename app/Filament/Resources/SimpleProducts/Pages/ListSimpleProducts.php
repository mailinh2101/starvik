<?php

namespace App\Filament\Resources\SimpleProducts\Pages;

use App\Filament\Resources\SimpleProducts\SimpleProductResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSimpleProducts extends ListRecords
{
    protected static string $resource = SimpleProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
