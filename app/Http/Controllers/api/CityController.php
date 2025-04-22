<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\City;
use App\Http\Resources\CityResource;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    public function getCities()
    {
        $city = City::all();
        return response()->json($city);
    }

    public function getCityId($CityName)
    {
        $city = City::where("city", $CityName)->first();
        return $city ? $city->id : null;
    }
}
