<?php

namespace App\Filament\Resources\TransactionDetailsRelationManagerResource\Pages;

use App\Filament\Resources\TransactionDetailsRelationManagerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransactionDetailsRelationManager extends EditRecord
{
    protected static string $resource = TransactionDetailsRelationManagerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
