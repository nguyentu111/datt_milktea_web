<?php

namespace App\Tables;

use App\Models\Category;
use App\Models\Position;
use App\Tables\Actions\DeleteAction;
use App\Tables\Actions\LinkAction;
use App\Tables\Columns\ActionColumn;
use App\Tables\Columns\TextColumn;
use App\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PositionTable extends Table
{
    protected string|null $heading = 'Position list';

    protected string|null $description = 'List of all of position';

    public function selectedColumns(): array
    {
        return [
            'id',
            'shelf_name',
            'description',
            'block_name',
            'created_at',
            'updated_at',
        ];
    }

    protected function query(): Builder|HasMany
    {
        return Position::query()
            ->withCount('goods');
    }

    protected function addRoute(): string
    {
        return route('positions.create');
    }

    protected function addLabel(): string
    {
        return __('Add new position');
    }

    protected function columns(): array
    {
        return [
            TextColumn::make('id')
                ->label('Id'),
            TextColumn::make('block_name')
                ->label('Block'),
            TextColumn::make('shelf_name')
                ->label('Shelf'),
            TextColumn::make('description')
                ->label('Description'),
            TextColumn::make('goods_count')
                ->label('Number of goods'),
            TextColumn::make('created_at')
                ->label('Created at'),
            TextColumn::make('updated_at')
                ->label('Updated at'),
            ActionColumn::make()
                ->label('Action')
                ->actions(
                    LinkAction::make()
                        ->label('View')
                        ->url(fn (Position $postion): string => route('positions.show', $postion)),
                    DeleteAction::make()
                        ->url(fn (Position $postion): string => route('positions.destroy', $postion)),
                ),
        ];
    }

    protected function modals(): array
    {
        return [];
    }
}