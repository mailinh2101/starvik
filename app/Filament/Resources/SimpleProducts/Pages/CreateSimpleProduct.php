<?php

namespace App\Filament\Resources\SimpleProducts\Pages;

use App\Filament\Resources\SimpleProducts\SimpleProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSimpleProduct extends CreateRecord
{
    protected static string $resource = SimpleProductResource::class;
}
