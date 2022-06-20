<?php

namespace App\Http\Controllers;

use App\Models\CitiesGroup;
use App\Models\City;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CitiesGroupController extends Controller
{
    public function all()
    {
        // Return all data
        return CitiesGroup::orderBy('group_id', 'ASC')->get();
    }

    public function insert(Request $request)
    {
        // Get data post
        $data = $request->all();

        // Validate data post
        $validator = Validator::make($data, [
            'city_id' => 'numeric',
            'group_id' => 'numeric',
        ]);
        if($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 400);
        }

        // Check exist city and group
        if(!City::find($request->input('city_id')) || !Group::find($request->input('group_id')))
            return 'City or group not found.';

        // Save data
        $cities_group = CitiesGroup::create($data);

        // Check save
        if($cities_group)
            return 'City and group successfuly saved.';

        return 'Oops! An error ocurred, check data and try again.';

    }

    public function delete($city_group_id)
    {
        // Check exist
        if(!CitiesGroup::find($city_group_id))
            return 'Data not found.';

        // Delete
        if(CitiesGroup::find($city_group_id)->delete())
            return 'City and group removed.';

        return 'Oops! An error ocurred, try again.';
    }
}
