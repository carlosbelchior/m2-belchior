<?php

namespace App\Http\Controllers;

use App\Models\CitiesGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    public function all()
    {
        // Return all products
        return CitiesGroup::all();
    }

    public function insert(Request $request)
    {
        // Get data post
        $data = $request->all();

        // Validate data post
        $validator = Validator::make($data, [
            'name' => 'required|unique:App\Models\CitiesGroup,name'
        ]);
        if($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 400);
        }
        
        // Save product
        $group = CitiesGroup::create($data);

        // Check save
        if($group)
            return 'Group city successfuly saved.';

        return 'Oops! An error ocurred, check data and try again.';

    }

    public function update(Request $request, $city_id)
    {
        // Get data post
        $data = $request->all();
        $group_city = CitiesGroup::find($city_id);

        // Check city exist
        if(!CitiesGroup::find($city_id))
            return 'Group city city not found.';

        // Validate data post
        $validator = Validator::make($data, [
            'name' => 'required|unique:App\Models\CitiesGroup,name'
        ]);
        if($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 400);
        }

        if($group_city->update($data))
            return 'Group city successfuly updated.';

        return 'Oops! An error ocurred, check data and try again.';
    }

    public function delete($group_id)
    {
        if(!CitiesGroup::find($group_id))
            return 'Group city not found.';

        if(CitiesGroup::find($group_id)->delete())
            return 'Group city delete successfuly.';

        return 'Oops! An error ocurred, try again.';
    }
}
