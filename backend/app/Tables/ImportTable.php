<?php

namespace App\Tables;

use App\Models\Import;
use App\Tables\Actions\DeleteAction;
use App\Tables\Actions\LinkAction;
use App\Tables\Columns\ActionColumn;
use App\Tables\Columns\TextColumn;
use App\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ImportTable extends Table
{
    protected string|null $heading = 'Import list';

    protected string|null $description = 'List of all of import vouchers';

    protected function addRoute(): string
    {
        return route('imports.create');
    }

    protected function addLabel(): string
    {
        return __('Add new import');
    }

    public function selectedColumns(): array
    {
        return [
            'name',
            'email',
            'address',
            'phone_number',
            'created_at',
        ];
    }

    protected function query(): Builder|HasMany
    {
        return Import::query()->with('user')->with('customer');
    }

    protected function columns(): array
    {
        return [
            TextColumn::make('id')
                ->label('Id'),
            TextColumn::make('user')
                ->withSub('name')
                ->label('Created by'),
            TextColumn::make('customer')
                ->withSub('name')
                ->label('Customer'),
            TextColumn::make('customer')
                ->withSub('address')
                ->label('Customer address'),
            TextColumn::make('customer')
                ->withSub('phone_number')
                ->label('Customer phone number'),
            TextColumn::make('created_at')
                ->label('Created at'),
            ActionColumn::make()
                ->label('Action')
                ->actions(
                    LinkAction::make()
                        ->label('View')
                        ->url(fn (Import $import): string => route('imports.show', $import)),
                    DeleteAction::make()
                        ->url(fn (Import $import): string => route('imports.destroy', $import)),
                ),
        ];
    }

    protected function modals(): array
    {
        return [];
    }
}
