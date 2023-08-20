<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller
{
    protected $city;

    public function __construct(
        City $city
    ) {
        $this->city = $city;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllCitiesFromTheState(Request $request, State $state)
    {
        return $this->city->getAllCitiesFromTheState($state->id);
    }
}
