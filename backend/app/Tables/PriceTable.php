<?php

namespace App\Tables;

use App\Models\BranchMaterial;
use App\Models\Product;
use App\Models\Staff;
use App\Models\Tax;
use App\Models\Uom;
use App\Tables\Actions\DeleteAction;
use App\Tables\Actions\LinkAction;
use App\Tables\Columns\ActionColumn;
use App\Tables\Columns\TextColumn;
use App\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PriceTable extends Table
{
    protected string|null $heading = 'Product price list';

    protected string|null $description = 'List of all product price';


    protected function query(): Builder|HasMany
    {
        return Product::query();
    }

    protected function addRoute(): string
    {
        return route('prices.create');
    }

    protected function addLabel(): string
    {
        return __('view detail');
    }

    protected function columns(): array
    {
        return [
            TextColumn::make('id')
                ->label('id'),
            TextColumn::make('name')
                ->label('Product name'),
            TextColumn::make('currentImportPrice')
                ->money()
                ->label('Current import price'),
            TextColumn::make('currentExportPrice')
                ->money()
                ->label('Current export price'),
        ];
    }

    protected function modals(): array
    {
        return [];
    }
}
