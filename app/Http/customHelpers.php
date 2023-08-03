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

if (! function_exists('convertMaskToDecimal')) {
    function convertMaskToDecimal(string|null $value)
    {
        if (! is_null($value) || (! empty($value))) {
            $source = array('.', ',');
            $replace = array('', '.');
            $valueConverted = str_replace($source, $replace, $value);

            return $valueConverted;
        }
        return 0;
    }
}

if (! function_exists('convertDecimalToBRL')) {
    function convertDecimalToBRL($value)
    {
        if (! is_null($value) || (! empty($value))) {
            $BRLValue = number_format($value, 2, ',', '.');
            return $BRLValue;
        }
        return 0;
    }

}

if (! function_exists('findZoneForStates')) {
    function findZoneForStates($state)
    {
        $zone = null;
        switch ($state) {
            // REGIÃO NORTE
            case 'AC':
            case 'AM':
            case 'AP':
            case 'PA':
            case 'RO':
            case 'RR':
            case 'TO':
                $zone = 'NORTE';
                break;

            // REGIÃO NORDESTE
            case 'AL':
            case 'BA':
            case 'CE':
            case 'MA':
            case 'PB':
            case 'PE':
            case 'PI':
            case 'RN':
            case 'SE':
                $zone = 'NORDESTE';
                break;

            // REGIÃO CENTRO-OESTE
            case 'DF':
            case 'GO':
            case 'MT':
            case 'MS':
                $zone = 'CENTRO-OESTE';
                break;

            // REGIÃO SUDESTE
            case 'ES':
            case 'MG':
            case 'RJ':
            case 'SP':
                $zone = 'SUDESTE';
                break;

            // REGIÃO SUL
            case 'PR':
            case 'RS':
            case 'SC':
                $zone = 'SUL';
                break;

            default:
                break;
        }

        return $zone;
    }
}