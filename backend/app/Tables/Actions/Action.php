<?php

namespace App\Tables\Actions;

use Closure;
use Illuminate\Database\Eloquent\Model;

abstract class Action
{
    protected string|null $label = null;

    protected Closure|string|null $url = null;
    protected Closure|null $showWhen = null;

    public function showWhen(Closure $callback)
    {
        $this->showWhen = $callback;
        return $this;
    }
    protected function canShow(Model $model): bool
    {
        if ($this->showWhen) {
            return call_user_func_array($this->showWhen, [$model]);
        } else return true;
    }
    public function __construct(protected string|null $name)
    {
    }

    abstract public function render(Model $model);

    public static function make(string|null $name = null): self
    {
        return new static($name);
    }

    public function label(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function url(Closure|string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getLabel(): string|null
    {
        return __($this->label);
    }

    public function getName(): string|null
    {
        return $this->name;
    }

    public function getUrl(Model $model): string|null
    {
        return call_user_func_array($this->url, [$model]);
    }
}
