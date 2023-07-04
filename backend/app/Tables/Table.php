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
    protected function modals(): array
    {
        return [];
    }
}
