<?php

namespace App\Tables\Columns\Concerns;

use Closure;
use Illuminate\Database\Eloquent\Model;

trait HasUrl
{
    protected Closure|string|null $url = null;

    protected bool $isOpenInNewTab = false;

    public function url(Closure|string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function openInNewTab(bool $openInNewTab = true): static
    {
        $this->isOpenInNewTab = $openInNewTab;

        return $this;
    }

    public function getUrl(Model $model): string|null
    {
        if (!isset($this->url)) {
            return null;
        }

        return call_user_func_array($this->url, [$model]);
    }

    public function isOpenInNewTab(): bool
    {
        return $this->isOpenInNewTab;
    }
}