<?php

namespace App\Tables;

use App\Models\Goods;
use App\Tables\Actions\DeleteAction;
use App\Tables\Actions\LinkAction;
use App\Tables\Columns\ActionColumn;
use App\Tables\Columns\TextColumn;
use App\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GoodsTable extends Table
{
    protected string|null $heading = 'Goods list';

    protected string|null $description = 'List of all of goods';

    public function selectedColumns(): array
    {
        return [
            'id',
            'import_id',
            'export_id',
            'category_id',
            'position_id',
        ];
    }

    protected function query(): Builder|HasMany
    {
        return Goods::query()
            ->with('import')
            ->with('export')
            ->with('category')
            ->with('position');
    }

    protected function addRoute(): string
    {
        return route('goods.create');
    }

    protected function addLabel(): string
    {
        return __('Add new goods');
    }

    protected function columns(): array
    {
        return [
            TextColumn::make('id')
                ->label('Id'),
            TextColumn::make('category')
                ->withSub('name')
                ->label('Name'),
            TextColumn::make('import')
                ->withSub('created_at')
                ->label('Import date'),
            TextColumn::make('export')
                ->withSub('created_at')
                ->label('Export date'),
            TextColumn::make('position')
                ->withSub('shelf_name')
                ->label('Shelf'),
            TextColumn::make('position')
                ->withSub('block_name')
                ->label('Block'),
            ActionColumn::make()
                ->label('Action')
                ->actions(
                    LinkAction::make()
                        ->label('View')
                        ->url(fn (Goods $goods): string => route('goods.show', $goods)),
                    DeleteAction::make()
                        ->url(fn (Goods $goods): string => route('goods.destroy', $goods)),
                ),
        ];
    }

    protected function modals(): array
    {
        return [];
    }
}