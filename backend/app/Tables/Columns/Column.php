<?php

namespace App\Tables\Columns;

use App\Tables\Columns\Concerns\HasUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

abstract class Column
{
    use HasUrl;

    protected string|null $label = null;

    protected string|null $sub = null;

    public function __construct(protected string|null $attribute = null)
    {
    }

    public static function make(string $attribute = null): static
    {
        return new static($attribute);
    }

    public function label(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function render(Model $model): HtmlString|string|null
    {
        if ($this->sub && !$model->getAttribute($this->attribute)) {
            return '___';
        }

        return $this->sub ? $model->getAttribute($this->attribute)[$this->sub] :
            $model->getAttribute($this->attribute);
    }

    public function getLabel(): string|null
    {
        $label = $this->label ?? (string) str($this->getAttribute())
            ->beforeLast('.')
            ->afterLast('.')
            ->kebab()
            ->replace(['-', '_'], ' ')
            ->ucfirst();

        return __($label);
    }

    public function getAttribute(): string
    {
        return $this->attribute;
    }

    public function withSub(string $sub): static
    {
        $this->sub = $sub;

        return $this;
    }
}