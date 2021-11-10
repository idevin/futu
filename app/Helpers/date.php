<?php

use Illuminate\Support\Carbon;

/**
 * Return a Carbon instance.
 */
function carbon(string $parseString = '', string $tz = null): Carbon
{
    return new Carbon($parseString, $tz);
}

/**
 * Return a formatted Carbon date.
 */
function humanize_date(Carbon $date, string $format = 'd F Y'): string
{
    return $date->format('d') . ' ' . __('date.' . $date->month) . ' ' . $date->year;
}
