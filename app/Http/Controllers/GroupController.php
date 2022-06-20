<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Models\CitiesGroup;
use App\Models\City;
use App\Models\Group;

class GroupController extends Controller
{
    public function all()
    {
        // Return all groups
        return Group::with(['campaign'])->get();
    }

    public function insert(Request $request)
    {
        // Get data post
        $data = $request->all();

        // Validate data post
        $validator = Validator::make($data, [
            'name' => 'required|min:3',
            'campaign_id' => 'nullable|numeric',
        ]);
        if($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 400);
        }

        // Check campaign exist and actived
        if(Campaign::find($request->input('campaign_id'))->status != 1)
            return 'Campaign not found or inactive.';
        
        // Save group
        $group = Group::create($data);

        // Check save
        if($group)
            return 'Group successfuly saved.';

        return 'Oops! An error ocurred, check data and try again.';

    }

    public function update(Request $request, $group_id)
    {
        // Check group exist
        if(!Group::find($group_id))
            return 'Group not found.';

        // Get data post
        $data = $request->all();
        $group = Group::find($group_id);

        // Validate data post
        $validator = Validator::make($data, [
            'name' => 'required|min:3',
            'campaign_id' => 'nullable|numeric',
        ]);
        if($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 400);
        }

        // Check campaign exist and actived
        if(!$request->input('campaign_id'))
            $data['campaign_id'] = NULL;

        // Check campaign exist and actived
        if($request->input('campaign_id') && Campaign::find($request->input('campaign_id'))->status != 1)
            return 'Campaign not found or inactive.';
            
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

        // Try delete group
        try {

            City::where('group_id', $group_id)->update(['group_id' => NULL]);
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
