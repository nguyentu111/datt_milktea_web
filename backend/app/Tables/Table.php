<?php

namespace App\Tables;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

abstract class Table
{
    protected int $perPage = 15;
    
    protected string|null $heading = null;
    
    protected string|null $description = null;
    
    public function __construct(
  
        protected Request $request
    ) {
    }

    abstract protected function query(): Builder|HasMany;

    abstract protected function columns(): array;

    protected function modals(): array
    {
        return [];
    }

    abstract protected function addRoute(): string;

    abstract protected function addLabel(): string;

    public function render(): View
    {
        return view('bewama::components.table.table', [
            'heading' => $this->heading,
            'description' => $this->description,
            'add_label' => $this->addLabel(),
            'add_route' => $this->addRoute(),
            'columns' => $this->columns(),
            'modals' => $this->modals(),
            'rows' => $this->query()->paginate($this->perPage),
        ]);
    }
}