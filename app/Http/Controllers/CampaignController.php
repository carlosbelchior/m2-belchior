<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function all()
    {

    }

    public function insert(Request $request)
    {
        
    }

    public function update(Request $request, $campaign_id)
    {
        
    }

    public function delete($campaign_id)
    {
        if(!Campaign::find($campaign_id))
            return 'Campaign not found.';

        if(Campaign::drop($campaign_id))
            return 'Campaign delete successfuly.';

        return 'Oops! An error ocurred, try again.';
    }
}
