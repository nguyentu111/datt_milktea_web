<?php

namespace App\Tables\Actions;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;

class LinkAction extends Action
{
    public function render(Model $model): View|string
    {
        return view('bewama::components.actions.link', [
            'label' => $this->getLabel(),
            'url' => $this->getUrl($model),
        ]);
    }
}
