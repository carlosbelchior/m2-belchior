<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function all()
    {
        return City::all();
    }

    public function insert(Request $request)
    {
        $data = $request->all();
    }

    public function update(Request $request, $city_id)
    {
        $data = $request->all();
        $city = City::find($city_id);
        
        if(!$city)
            return 'City not found.';

    }

    public function delete($city_id)
    {
        if(!City::find($city_id))
            return 'City not found.';

        if(City::drop($city_id))
            return 'City delete successfuly.';

        return 'Oops! An error ocurred, try again.';
    }
}
