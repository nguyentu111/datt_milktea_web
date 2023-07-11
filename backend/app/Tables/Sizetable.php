<?php

namespace App\Tables;

use App\Models\Size;
use App\Tables\Actions\DeleteAction;
use App\Tables\Actions\LinkAction;
use App\Tables\Columns\ActionColumn;
use App\Tables\Columns\TextColumn;
use App\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SizeTable extends Table
{
    protected string|null $heading = 'Size list';

    protected string|null $description = 'List of all sizes';


    protected function query(): Builder|HasMany
    {
        return Size::query();
    }

    protected function addRoute(): string
    {
        return route('sizes.create');
    }

    protected function addLabel(): string
    {
        return __('Add new size');
    }

    protected function columns(): array
    {
        return [
            TextColumn::make('id')
                ->label('id'),
            TextColumn::make('name')
                ->label('size name'),
            ActionColumn::make()
                ->label('Action')
                ->actions(
                    DeleteAction::make()
                        ->label('Delete')
                        ->url(fn (Size $size): string => route('sizes.destroy', $size)),
                ),
        ];
    }

    protected function modals(): array
    {
        return [];
    }
}
