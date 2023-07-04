<?php

namespace App\Tables\Columns;

use App\Tables\Columns\Concerns\CanBeFormatted;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

class TextColumn extends Column
{
    use CanBeFormatted;

    public function render(Model $model): HtmlString|string|null
    {
        if ($this->formatStateUsing) {
            return call_user_func_array(
                $this->formatStateUsing,
                [$model->getAttribute($this->attribute), $model]
            );
        }

        return parent::render($model);
    }
}