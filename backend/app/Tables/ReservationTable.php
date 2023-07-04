<?php

namespace App\Tables;

use App\Models\Reservation;
use App\Tables\Actions\DeleteAction;
use App\Tables\Actions\LinkAction;
use App\Tables\Columns\ActionColumn;
use App\Tables\Columns\TextColumn;
use App\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReservationTable extends Table
{
    protected string|null $heading = 'Reservation list';

    protected string|null $description = '';

    public function selectedColumns(): array
    {
        return [
            'id',
            'name',
            'description',
            'created_at',
            'updated_at',
        ];
    }

    protected function query(): Builder|HasMany
    {
        $queryBuilder = Reservation::query();

        if ($categoryId = $this->request->route('categories.show')) {

            $queryBuilder->where('category_id', $categoryId);
        }
        return $queryBuilder->select($this->selectedColumns());
    }

    protected function addRoute(): string
    {
        return route('reservations.create');
    }

    protected function addLabel(): string
    {
        return __('Add new reservation');
    }

    protected function columns(): array
    {
        return [
            TextColumn::make('id')
                ->label('Id'),
            TextColumn::make('name')
                ->label('name'),
            TextColumn::make('description')
                ->label('description'),
            TextColumn::make('created_at')
                ->label('Created at'),
            TextColumn::make('updated_at')
                ->label('Updated at'),
            ActionColumn::make()
                ->label('Action')
                ->actions(
                    LinkAction::make()
                        ->label('View')
                        ->url(fn (Reservation $reservation): string => route('reservations.show', $reservation)),
                    DeleteAction::make()
                        ->url(fn (Reservation $reservation): string => route('reservations.destroy', $reservation)),
                ),
        ];
    }

    protected function modals(): array
    {
        return [];
    }
}