<?php

namespace App\Tables;

use App\Models\BranchMaterial;
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

class UomTable extends Table
{
    protected string|null $heading = 'Unit of material list';

    protected string|null $description = 'List of all unit of materials';


    protected function query(): Builder|HasMany
    {
        return Uom::query();
    }

    protected function addRoute(): string
    {
        return route('uoms.create');
    }

    protected function addLabel(): string
    {
        return __('Add new uom');
    }

    protected function columns(): array
    {
        return [
            TextColumn::make('id')
                ->label('id'),
            TextColumn::make('name')
                ->label('Uom name'),
            TextColumn::make('created_at')
                ->label('Created at'),
            ActionColumn::make()
                ->label('Action')
                ->actions(
                    DeleteAction::make()
                        ->label('Delete')
                        ->url(fn (Uom $uom): string => route('uoms.destroy', $uom)),
                ),
        ];
    }

    protected function modals(): array
    {
        return [];
    }
}
