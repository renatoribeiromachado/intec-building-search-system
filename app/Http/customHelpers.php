<?php

use Carbon\Carbon;

if (! function_exists('convertPtBrDateToEnDate')) {
    function convertPtBrDateToEnDate($date)
    {
        if ($date) {
            return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        }
        return null;
    }
}
