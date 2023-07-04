<?php

namespace App\Tables\Columns;

use App\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

class ActionColumn extends Column
{
    protected array $actions = [];

    public function actions(Action ...$actions): self
    {
        $this->actions = $actions;

        return $this;
    }

    public function render(Model $model): HtmlString|string|null
    {
        if (!$this->actions) {
            return null;
        }

        return view('bewama::components.columns.action', [
            'actions' => $this->actions,
            'model' => $model,
        ])->render();
    }
}
