<?php

namespace App\Tables;

use App\Models\Product;
use App\Tables\Actions\LinkAction;
use App\Tables\Columns\ActionColumn;
use App\Tables\Columns\TextColumn;
use App\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductTable extends Table
{
    protected string|null $heading = 'Products list';

    protected string|null $description = 'List of all products';

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
        return Product::query()->with(['tax', 'type'])->orderBy('created_at');
    }

    protected function addRoute(): string
    {
        return route('products.create');
    }

    protected function addLabel(): string
    {
        return __('Add new product');
    }

    protected function columns(): array
    {
        return [
            TextColumn::make('id')
                ->label('id'),
            TextColumn::make('name')
                ->label('Name'),
            TextColumn::make('description')
                ->label('Description'),
            TextColumn::make('tax')
                ->withSub('percent')
                ->label('tax'),
            TextColumn::make('uom')
                ->withSub('name')
                ->label('Uom'),
            TextColumn::make('type')
                ->withSub('name')
                ->label('Type'),
            TextColumn::make('active')
                ->castBool()
                ->label('Is active'),
            ActionColumn::make()
                ->label('Action')
                ->actions(
                    LinkAction::make()
                        ->label('View')
                        ->url(fn (Product $product): string => route('products.show', $product)),
                ),
        ];
    }

    protected function modals(): array
    {
        return [];
    }
}
