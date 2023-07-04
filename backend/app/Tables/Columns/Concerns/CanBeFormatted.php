<?php

namespace App\Tables\Columns\Concerns;

use Carbon\Carbon;
use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait CanBeFormatted
{
    protected Closure|null $formatStateUsing = null;

    public function formatStateUsing(Closure|null $callback): static
    {
        $this->formatStateUsing = $callback;

        return $this;
    }

    public function dateTime(string $format = null): static
    {
        $format ??= 'Y-m-d';

        $this->formatStateUsing(
            fn (string $state, Model $model): string
            => Carbon::parse($state)->translatedFormat($format)
        );

        return $this;
    }

    public function money(): static
    {
        $this->formatStateUsing(
            fn (string|null $state): string|null
            => $state ? '$' . number_format($state, 2) : null
        );

        return $this;
    }

    public function limit(int $limit = 100): static
    {
        $this->formatStateUsing(fn (string $state): string => Str::limit($state, $limit));

        return $this;
    }
}