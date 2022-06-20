<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\City;
use App\Models\CitiesGroup;
use App\Models\Group;

class CityController extends Controller
{
    public function all()
    {
        // Return all cities
        return City::with(['group'])->get();
    }

    public function insert(Request $request)
    {
        // Get data post
        $data = $request->all();

        // Validate data post
        $validator = Validator::make($data, [
            'name' => 'required|min:3',
            'group_id' => 'nullable|numeric',
        ]);
        if($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 400);
        }

        // Check group exist
        if($request->input('group_id') && !Group::find($request->input('group_id')))
            return 'Group not found.';
        
        // Save city
        $city = City::create($data);

        // Check save
        if($city)
            return 'City successfuly saved.';

        return 'Oops! An error ocurred, check data and try again.';

    }

    public function update(Request $request, $city_id)
    {
        // Check city exist
        if(!City::find($city_id))
            return 'City not found.';
    
        // Get data post
        $data = $request->all();
        $city = City::find($city_id);

        // Validate data post
        $validator = Validator::make($data, [
            'name' => 'required|min:3',
            'group_id' => 'nullable|numeric',
        ]);
        if($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 400);
        }

        // Check group exist
        if($request->input('group_id') && !Group::find($request->input('group_id')))
            return 'Group not found.';

        // Update city
        if($city->update($data))
            return 'City successfuly updated.';

        return 'Oops! An error ocurred, check data and try again.';
    }

    public function delete($city_id)
    {
        // Check city exist
        if(!City::find($city_id))
            return 'City not found.';

        // Delete city
        if(City::find($city_id)->delete())
            return 'City successfuly deleted.';

        return 'Oops! An error ocurred, try again.';
    }
}
