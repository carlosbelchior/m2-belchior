<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    public function all()
    {
        // Return all products
        return Group::all();
    }

    public function insert(Request $request)
    {
        // Get data post
        $data = $request->all();

        // Validate data post
        $validator = Validator::make($data, [
            'name' => 'required|unique:App\Models\Group,name'
        ]);
        if($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 400);
        }
        
        // Save product
        $group = Group::create($data);

        // Check save
        if($group)
            return 'Group successfuly saved.';

        return 'Oops! An error ocurred, check data and try again.';

    }

    public function update(Request $request, $city_id)
    {
        // Get data post
        $data = $request->all();
        $group_city = Group::find($city_id);

        // Check city exist
        if(!Group::find($city_id))
            return 'Group not found.';

        // Validate data post
        $validator = Validator::make($data, [
            'name' => 'required|unique:App\Models\Group,name'
        ]);
        if($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 400);
        }

        if($group_city->update($data))
            return 'Group successfuly updated.';

        return 'Oops! An error ocurred, check data and try again.';
    }

    public function delete($group_id)
    {
        if(!Group::find($group_id))
            return 'Group not found.';

        if(Group::find($group_id)->delete())
            return 'Group delete successfuly.';

        return 'Oops! An error ocurred, try again.';
    }
}
