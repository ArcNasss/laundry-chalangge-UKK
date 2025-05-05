<?php
// app/Filament/Resources/TaxResource/Pages/ManageTaxes.php

namespace App\Filament\Resources\TaxResource\Pages;

use App\Filament\Resources\TaxResource;
use Filament\Resources\Pages\ManageRecords;

class ManageTaxes extends ManageRecords
{
    protected static string $resource = TaxResource::class;

    // protected function getHeaderActions(): array
    // {
    //     // return []; // Hilangkan tombol Create
    // }
}
