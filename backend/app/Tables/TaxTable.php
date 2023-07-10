<?php

namespace App\Tables;

use App\Models\Staff;
use App\Models\Tax;
use App\Tables\Actions\DeleteAction;
use App\Tables\Actions\LinkAction;
use App\Tables\Columns\ActionColumn;
use App\Tables\Columns\TextColumn;
use App\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaxTable extends Table
{
    protected string|null $heading = 'Tax list';

    protected string|null $description = 'List of all taxes';

    // public function selectedColumns(): array
    // {
    //     return [
    //         'id',
    //         'name',
    //         'email',
    //         'address',
    //         'phone_number',
    //         'created_at',
    //     ];
    // }

    protected function query(): Builder|HasMany
    {
        return Tax::query();
    }

    protected function addRoute(): string
    {
        return route('taxes.create');
    }

    protected function addLabel(): string
    {
        return __('Add new tax');
    }

    protected function columns(): array
    {
        return [
            TextColumn::make('id')
                ->label('id'),
            TextColumn::make('name')
                ->label('Tax name'),
            TextColumn::make('percent')
                ->label('Percent'),
            ActionColumn::make()
                ->label('Action')
                ->actions(
                    DeleteAction::make()
                        ->label('Delete')
                        ->url(fn (Tax $tax): string => route('taxes.destroy', $tax)),
                ),
        ];
    }

    protected function modals(): array
    {
        return [];
    }
}
