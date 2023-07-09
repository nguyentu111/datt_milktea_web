<?php

namespace App\Tables;

use App\Models\Branch;
use App\Tables\Actions\DeleteAction;
use App\Tables\Actions\LinkAction;
use App\Tables\Columns\ActionColumn;
use App\Tables\Columns\TextColumn;
use App\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BranchTable extends Table
{
    protected string|null $heading = 'Branch list';

    protected string|null $description = 'List of all branches';

    public function selectedColumns(): array
    {
        return [
            'id',
            'name',
            'address',
            'phone',
            'picture',
            'active',
            'date_open',
        ];
    }

    protected function query(): Builder|HasMany
    {
        return Branch::query()->select($this->selectedColumns());
    }

    protected function addRoute(): string
    {
        return route('branches.create');
    }

    protected function addLabel(): string
    {
        return __('Add new branches');
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
            TextColumn::make('active')->castBool()
                ->label('Active'),
            TextColumn::make('date_open')
                ->label('Date open'),
            ActionColumn::make()
                ->label('Action')
                ->actions(
                    LinkAction::make()
                        ->label('View')
                        ->url(fn (Branch $branch): string => route('branches.show', $branch)),
                    DeleteAction::make()
                        ->url(fn (Branch $branch): string => route('branches.destroy', $branch)),
                ),
        ];
    }

    protected function modals(): array
    {
        return [];
    }
}
