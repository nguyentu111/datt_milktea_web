<?php

namespace App\Tables;

use App\Models\Customer;
use App\Tables\Actions\DeleteAction;
use App\Tables\Actions\LinkAction;
use App\Tables\Columns\ActionColumn;
use App\Tables\Columns\TextColumn;
use App\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CustomerTable extends Table
{
    protected string|null $heading = 'Customer list';

    protected string|null $description = 'List of all of customers';

    public function selectedColumns(): array
    {
        return [
            'id',
            'name',
            'email',
            'address',
            'phone_number',
            'created_at',
        ];
    }

    protected function query(): Builder|HasMany
    {
        return Customer::query()->select($this->selectedColumns());
    }

    protected function addRoute(): string
    {
        return route('customers.create');
    }

    protected function addLabel(): string
    {
        return __('Add new customer');
    }

    protected function columns(): array
    {
        return [
            TextColumn::make('id')
                ->label('id'),
            TextColumn::make('name')
                ->label('Name'),
            TextColumn::make('email')
                ->label('Email'),
            TextColumn::make('address')
                ->label('Address'),
            TextColumn::make('phone_number')
                ->label('Phone number'),
            TextColumn::make('created_at')
                ->label('Created at'),
            ActionColumn::make()
                ->label('Action')
                ->actions(
                    LinkAction::make()
                        ->label('View')
                        ->url(fn (Customer $customer): string => route('customers.show', $customer)),
                    DeleteAction::make()
                        ->url(fn (Customer $customer): string => route('customers.destroy', $customer)),
                ),
        ];
    }

    protected function modals(): array
    {
        return [];
    }
}
