<?php

namespace App\Http\Controllers;

use App\Models\CitiesGroup;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    public function all()
    {
        // Return all products
        return City::all();
    }

    public function insert(Request $request)
    {
        // Get data post
        $data = $request->all();

        // Check campaign exist
        if($request->group_id && !City::find($request->group_id))
            return 'Group not found.';
        
        // Validate data post
        $validator = Validator::make($data, [
            'name' => 'required|unique:App\Models\City,name',
            'group_id' => 'nullable|numeric',
        ]);
        if($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 400);
        }
        
        // Save product
        $product = City::create($data);

        // Check save
        if($product)
            return 'City successfuly saved.';

        return 'Oops! An error ocurred, check data and try again.';

    }

    public function update(Request $request, $city_id)
    {
        // Get data post
        $data = $request->all();
        $city = City::find($city_id);

        // Check group exist
        if($request->campaign_id && !CitiesGroup::find($request->campaign_id))
            return 'Campaign not found.';

        // Check city exist
        if(!City::find($city_id))
            return 'City not found.';

        // Validate data post
        $validator = Validator::make($data, [
            'name' => 'required|unique:App\Models\City,name',
            'group_id' => 'nullable|numeric',
        ]);
        if($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 400);
        }

        if($city->update($data))
            return 'City successfuly updated.';

        return 'Oops! An error ocurred, check data and try again.';
    }

    public function delete($city_id)
    {
        if(!City::find($city_id))
            return 'City not found.';

        if(City::find($city_id)->delete())
            return 'City delete successfuly.';

        return 'Oops! An error ocurred, try again.';
    }
}
