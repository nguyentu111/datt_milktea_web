<?php

namespace App\Tables;

use App\Models\User;
use App\Tables\Actions\DeleteAction;
use App\Tables\Actions\LinkAction;
use App\Tables\Columns\ActionColumn;
use App\Tables\Columns\TextColumn;
use App\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserTable extends Table
{
    protected string|null $heading = 'Users list';

    protected string|null $description = 'List of all of users';

    public function selectedColumns(): array
    {
        return [
            'id',
            'name',
            'email',
            'phone_number',
            'dob',
            'created_at',
        ];
    }

    protected function query(): Builder|HasMany
    {
        return User::query()->select($this->selectedColumns());
    }

    protected function addRoute(): string
    {
        return route('users.create');
    }

    protected function addLabel(): string
    {
        return __('Add new user');
    }

    protected function columns(): array
    {
        return [
            TextColumn::make('id')
                ->label('Id'),
            TextColumn::make('name')
                ->label('Name'),
            TextColumn::make('email')
                ->label('Email'),
            TextColumn::make('phone_number')
                ->label('Phone number'),
            TextColumn::make('dob')
                ->label('Date of birth'),
            TextColumn::make('created_at')
                ->label('Created at'),
            ActionColumn::make()
                ->label('Action')
                ->actions(
                    LinkAction::make()
                        ->label('View')
                        ->url(fn (User $user): string => route('users.show', $user)),
                    DeleteAction::make()
                        ->url(fn (User $user): string => route('users.destroy', $user)),
                ),
        ];
    }

    protected function modals(): array
    {
        return [];
    }
}
