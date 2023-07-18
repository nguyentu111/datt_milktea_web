<?php

namespace App\Tables;

use App\Models\Promotion;
use App\Tables\Actions\DeleteAction;
use App\Tables\Actions\LinkAction;
use App\Tables\Columns\ActionColumn;
use App\Tables\Columns\TextColumn;
use App\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PromotionTable extends Table
{
    protected string|null $heading = 'Promotion list';

    protected string|null $description = 'List of all promotion';


    protected function query(): Builder|HasMany
    {
        return Promotion::query();
    }

    protected function addRoute(): string
    {
        return route('promotions.create');
    }

    protected function addLabel(): string
    {
        return __('Add new promotion');
    }

    protected function columns(): array
    {
        return [
            TextColumn::make('id')
                ->label('id'),

            TextColumn::make('name')
                ->label('Promotion name'),
            TextColumn::make('from_time')
                ->label('From time'),
            TextColumn::make('to_time')
                ->label('To time'),
            ActionColumn::make()
                ->label('Action')
                ->actions(
                    LinkAction::make()
                        ->label('View')
                        ->url(fn (Promotion $promotion): string => route('promotions.show', $promotion)),
                    DeleteAction::make()
                        ->label('Delete')
                        ->url(fn (Promotion $promotion): string => route('promotions.destroy', $promotion)),
                ),

        ];
    }

    protected function modals(): array
    {
        return [];
    }
}
