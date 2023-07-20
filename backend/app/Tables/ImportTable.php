<?php

namespace App\Tables;

use App\Models\Import;
use App\Tables\Actions\DeleteAction;
use App\Tables\Actions\LinkAction;
use App\Tables\Columns\ActionColumn;
use App\Tables\Columns\TextColumn;
use App\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class ImportTable extends Table
{
    protected string|null $heading = 'Import list';

    protected string|null $description = 'List of all of imports';

    protected function addRoute(): string
    {
        return route('imports.create');
    }

    protected function addLabel(): string
    {
        return __('Add new import');
    }

    public function selectedColumns(): array
    {
        return [
            'name',
            'email',
            'address',
            'phone_number',
            'created_at',
        ];
    }

    protected function query(): Builder|HasMany
    {
        return Import::query()->with(['staff', 'supplier', 'branchSource', 'branchDes'])
            ->where('branch_des_id', Auth::user()->staff->branch->id)
            ->orderByDesc('created_at');
    }

    protected function columns(): array
    {
        return [
            TextColumn::make('id')
                ->label('Id'),
            TextColumn::make('staff')
                ->withSub('full_name')
                ->label('Staff'),
            TextColumn::make('supplier')
                ->withSub('name')
                ->label('Supplier'),
            TextColumn::make('branchSource')
                ->withSub('name')
                ->label('Branch Source'),
            TextColumn::make('created_at')
                ->label('Created at'),
            ActionColumn::make()
                ->label('Action')
                ->actions(
                    LinkAction::make()
                        ->label('View')
                        ->url(fn (Import $import): string => route('imports.show', $import)),
                ),
        ];
    }

    protected function modals(): array
    {
        return [];
    }
}
