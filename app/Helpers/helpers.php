<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    public static function formatDateDiff($start, $end)
    {
        $start = Carbon::parse($start);
        $end = Carbon::parse($end);

        $diffInDays = $start->diffInDays($end);
        $diffInHours = $start->copy()->addDays($diffInDays)->diffInHours($end);
        $diffInMinutes = $start->copy()->addDays($diffInDays)->addHours($diffInHours)->diffInMinutes($end);

        $result = '';

        if ($diffInDays > 0) {
            $result .= $diffInDays . ' өдөр ';
        }

        if ($diffInHours > 0) {
            $result .= $diffInHours . ' цаг ';
        }

        if ($diffInMinutes > 0) {
            $result .= $diffInMinutes . ' мин ';
        }

        return $result;
    }
}