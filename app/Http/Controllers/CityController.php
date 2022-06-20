<?php

namespace App\Http\Controllers;

use App\Models\CitiesGroup;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\City;

class CityController extends Controller
{
    public function all()
    {
        // Return all cities
        return City::with(['groups'])->get();
    }

    public function insert(Request $request)
    {
        // Get data post
        $data = $request->all();

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
        
        // Save city
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

        // Start transaction
        DB::beginTransaction();

        try {

            CitiesGroup::where('city_id', $city_id)->delete();
            City::find($city_id)->delete();
    
            DB::commit();
    
            return 'City delete successfuly.';
    
        } catch(Exception $e) {
            DB::rollback();
            return 'Oops! An error ocurred, try again.';
        }

        return 'Oops! An error ocurred, try again.';
    }
}
