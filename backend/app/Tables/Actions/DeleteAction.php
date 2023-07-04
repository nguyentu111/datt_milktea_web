<?php

namespace App\Tables\Actions;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;

class DeleteAction extends Action
{
    protected string|null $label = 'Delete';

    public function render(Model $model): View|string
    {
        return view('bewama::components.actions.delete', [
            'label' => $this->getLabel(),
            'model' => $model,
            'url' => $this->getUrl($model),
        ]);
    }
}