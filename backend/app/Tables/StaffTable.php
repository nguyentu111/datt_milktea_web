<?php

namespace App\Tables;

use App\Models\Staff;
use App\Tables\Actions\DeleteAction;
use App\Tables\Actions\LinkAction;
use App\Tables\Columns\ActionColumn;
use App\Tables\Columns\TextColumn;
use App\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StaffTable extends Table
{
    protected string|null $heading = 'Staff list';

    protected string|null $description = 'List of all staffs';

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
        return Staff::query()->with('branch')->with('user');
    }

    protected function addRoute(): string
    {
        return route('staffs.create');
    }

    protected function addLabel(): string
    {
        return __('Add new staff');
    }

    protected function columns(): array
    {
        return [
            TextColumn::make('id')
                ->label('id'),
            TextColumn::make('first_name')
                ->label('First name'),
            TextColumn::make('last_name')
                ->label('last_name'),
            TextColumn::make('user')
                ->withSub('email')
                ->label('Email'),
            TextColumn::make('branch')
                ->withSub('name')
                ->label('Branch'),
            TextColumn::make('phone')
                ->label('Phone number'),
            TextColumn::make('active')->castBool()
                ->label('Is active'),
            TextColumn::make('created_at')
                ->label('Created at'),
            ActionColumn::make()
                ->label('Action')
                ->actions(
                    LinkAction::make()
                        ->label('View')
                        ->url(fn (Staff $staff): string => route('staffs.show', $staff)),
                ),
        ];
    }

    protected function modals(): array
    {
        return [];
    }
}
