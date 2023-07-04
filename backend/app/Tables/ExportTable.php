<?php

namespace App\Tables;

use App\Models\Export;
use App\Tables\Actions\DeleteAction;
use App\Tables\Actions\LinkAction;
use App\Tables\Columns\ActionColumn;
use App\Tables\Columns\TextColumn;
use App\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExportTable extends Table
{
    protected string|null $heading = 'Export list';

    protected string|null $description = 'List of all of export vouchers';

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
        return Export::query()->with('user')->with('customer');
    }

    protected function addRoute(): string
    {
        return route('exports.create');
    }

    protected function addLabel(): string
    {
        return __('Add new export');
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
                        ->url(fn (Export $export): string => route('exports.show', $export)),
                    DeleteAction::make()
                        ->url(fn (Export $export): string => route('exports.destroy', $export)),
                ),
        ];
    }

    protected function modals(): array
    {
        return [];
    }
}