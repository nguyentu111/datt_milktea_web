<?php

namespace App\Tables;

use App\Models\Category;
use App\Models\User;
use App\Tables\Actions\DeleteAction;
use App\Tables\Actions\LinkAction;
use App\Tables\Columns\ActionColumn;
use App\Tables\Columns\TextColumn;
use App\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryTable extends Table
{
    protected string|null $heading = 'Categories list';

    protected string|null $description = 'List of all of category';

    public function selectedColumns(): array
    {
        return [
            'id',
            'name',
            'unit',
            'created_at',
            'updated_at',
        ];
    }

    protected function query(): Builder|HasMany
    {
        return Category::query()->select($this->selectedColumns());
    }

    protected function addRoute(): string
    {
        return route('categories.create');
    }

    protected function addLabel(): string
    {
        return __('Add new category');
    }

    protected function columns(): array
    {
        return [
            TextColumn::make('id')
                ->label('Id'),
            TextColumn::make('name')
                ->label('Name'),
            TextColumn::make('unit')
                ->label('Email'),
            TextColumn::make('created_at')
                ->label('Created at'),
            TextColumn::make('updated_at')
                ->label('Updated at'),
            ActionColumn::make()
                ->label('Action')
                ->actions(
                    LinkAction::make()
                        ->label('View')
                        ->url(fn (Category $category): string => route('categories.show', $category)),
                    DeleteAction::make()
                        ->url(fn (Category $category): string => route('categories.destroy', $category)),
                ),
        ];
    }

    protected function modals(): array
    {
        return [];
    }
}
