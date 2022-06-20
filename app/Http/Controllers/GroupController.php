<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Models\CitiesGroup;
use App\Models\Group;

class GroupController extends Controller
{
    public function all()
    {
        // Return all groups
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
        
        // Save group
        $group = Group::create($data);

        // Check save
        if($group)
            return 'Group successfuly saved.';

        return 'Oops! An error ocurred, check data and try again.';

    }

    public function update(Request $request, $group_id)
    {
        // Get data post
        $data = $request->all();
        $group = Group::find($group_id);

        // Check group exist
        if(!Group::find($group_id))
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

        // Update group
        if($group->update($data))
            return 'Group successfuly updated.';

        return 'Oops! An error ocurred, check data and try again.';
    }

    public function delete($group_id)
    {
        // Check group exist
        if(!Group::find($group_id))
            return 'Group not found.';

        // Start transaction
        DB::beginTransaction();

        // Try delete group and city_group
        try {

            CitiesGroup::where('group_id', $group_id)->delete();
            Group::find($group_id)->delete();
    
            DB::commit();
    
            return 'Group delete successfuly.';
    
        } catch(Exception $e) {
            DB::rollback();
            return 'Oops! An error ocurred, try again.';
        }

        return 'Oops! An error ocurred, try again.';
    }
}
