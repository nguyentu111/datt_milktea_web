<?php

namespace App\Tables\Actions;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;

class ResetPassAction extends Action
{
    public function render(Model $model): View|string
    {
        return view('bewama::components.actions.reset-pass', [
            'label' => $this->getLabel(),
            'url' => $this->getUrl($model),
        ]);
    }
}
