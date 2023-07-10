<?php

namespace App\Tables;

use App\Models\Type;
use App\Tables\Actions\DeleteAction;
use App\Tables\Actions\LinkAction;
use App\Tables\Columns\ActionColumn;
use App\Tables\Columns\TextColumn;
use App\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeTable extends Table
{
    protected string|null $heading = 'Type list';

    protected string|null $description = 'List of all types';

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
        return Type::query()->with('parentType');
    }

    protected function addRoute(): string
    {
        return route('types.create');
    }

    protected function addLabel(): string
    {
        return __('Add new type');
    }

    protected function columns(): array
    {
        return [
            TextColumn::make('id')
                ->label('id'),
            TextColumn::make('name')
                ->label('Type name'),
            TextColumn::make('slug')
                ->label('Slug'),
            TextColumn::make('parentType')
                ->withSub('name')
                ->label('Parent type'),
            ActionColumn::make()
                ->label('Action')
                ->actions(
                    LinkAction::make()->label('View')->url(fn (Type $type): string => route('types.show', $type)),
                    DeleteAction::make()
                        ->label('Delete')
                        ->url(fn (Type $type): string => route('types.destroy', $type))
                ),
        ];
    }

    protected function modals(): array
    {
        return [];
    }
}
