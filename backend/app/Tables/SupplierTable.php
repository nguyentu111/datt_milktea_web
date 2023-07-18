<?php

namespace App\Tables;

use App\Models\Branch;
use App\Models\Supplier;
use App\Tables\Actions\DeleteAction;
use App\Tables\Actions\LinkAction;
use App\Tables\Columns\ActionColumn;
use App\Tables\Columns\TextColumn;
use App\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SupplierTable extends Table
{
    protected string|null $heading = 'Supplier list';

    protected string|null $description = 'List of all suppliers';

    public function selectedColumns(): array
    {
        return [
            'id',
            'name',
            'address',
            'phone'
        ];
    }

    protected function query(): Builder|HasMany
    {
        return Supplier::query()->select($this->selectedColumns());
    }

    protected function addRoute(): string
    {
        return route('suppliers.create');
    }

    protected function addLabel(): string
    {
        return __('Add new supplier');
    }

    protected function columns(): array
    {
        return [
            TextColumn::make('id')
                ->label('id'),
            TextColumn::make('name')
                ->label('Name'),
            TextColumn::make('address')
                ->label('Address'),
            TextColumn::make('phone')
                ->label('Phone'),
            ActionColumn::make()
                ->label('Action')
                ->actions(
                    DeleteAction::make()
                        ->url(fn (Supplier $supplier): string => route('suppliers.destroy', $supplier)),
                ),
        ];
    }

    protected function modals(): array
    {
        return [];
    }
}
