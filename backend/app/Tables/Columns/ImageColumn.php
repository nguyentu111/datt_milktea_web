<?php

namespace App\Tables\Columns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

class ImageColumn extends Column
{
    public function render(Model $model): HtmlString|string|null
    {
        return view('bewama::components.columns.image', [
            'state' => parent::render($model),
        ])->render();
    }
}
