<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
    public function getAllCitiesFromTheState(Request $request)
    {
        $cities = $this->city->getAllCitiesFromTheState($request->state_acronym);
        
        return response()->json([
            'cities' => $cities
        ], Response::HTTP_OK);
    }
}
