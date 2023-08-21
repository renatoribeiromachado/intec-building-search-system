<?php

use App\Models\Associate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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

            // value converted
            return str_replace($source, $replace, $value);
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

if (! function_exists('fillLeftWithZeros')) {
    function fillLeftWithZeros($value, int $length = 4)
    {
        if (is_null($value) || empty($value)) {
            return 'String não encontrada.';
        }
        return str_pad($value, $length, "0", STR_PAD_LEFT);
    }
}

if (! function_exists('applyDiscount')) {

    /**
     * @param $value ex.: 400.00
     * @param $discountValue ex.: 20
     */
    function applyDiscount(float $value = null, float $discountValue = null, bool $inPercentage = true)
    {
        if ($inPercentage) {
            $result = (float) round( $value - ( ($discountValue * $value) / 100 ), 2 );
            return number_format($result, 2, ',', '.');
        }

        $result = round($value - $discountValue, 2);
        return number_format($result, 2, ',', '.');
    }
}

if (! function_exists('authUserIsAnAssociate')) {

    function authUserIsAnAssociate()
    {
        return in_array(
            Auth::user()->role->slug, [
                Associate::ASSOCIATE_MANAGER,
                Associate::ASSOCIATE_USER
            ]
        );
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