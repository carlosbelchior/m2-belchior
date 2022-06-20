<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Group;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CampaignController extends Controller
{
    public function all()
    {
        // Return all campaigns
        return Campaign::all();
    }

    public function insert(Request $request)
    {
        // Get data post
        $data = $request->all();

        // Validate data post
        $validator = Validator::make($data, [
            'name' => 'required|min:3',
            'status' => 'nullable|numeric',
        ]);
        if($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 400);
        }

        // Save city
        $campaign = Campaign::create($data);

        // Check save
        if($campaign)
            return 'Campaign successfuly saved.';

        return 'Oops! An error ocurred, check data and try again.';

    }

    public function update(Request $request, $campaign_id)
    {
        // Check campaign exist
        if(!Campaign::find($campaign_id))
            return 'Campaign not found.';
    
        // Get data post
        $data = $request->all();
        $campaign = Campaign::find($campaign_id);

        // Validate data post
        $validator = Validator::make($data, [
            'name' => 'required|min:3',
            'status' => 'required|numeric',
        ]);
        if($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 400);
        }

        // Update city
        if($campaign->update($data))
            return 'Campaign successfuly updated.';

        return 'Oops! An error ocurred, check data and try again.';
    }

    public function delete($campaign_id)
    {
        // Check city exist
        if(!Campaign::find($campaign_id))
            return 'Campaign not found.';

        // Start transaction
        DB::beginTransaction();

        // Try delete campaign
        try {

            Group::where('campaign_id', $campaign_id)->update(['campaign_id' => NULL]);
            Campaign::find($campaign_id)->delete();
    
            DB::commit();
    
            return 'Campaign delete successfuly.';
    
        } catch(Exception $e) {
            DB::rollback();
            return 'Oops! An error ocurred, try again.';
        }

        return 'Oops! An error ocurred, try again.';
    }
}