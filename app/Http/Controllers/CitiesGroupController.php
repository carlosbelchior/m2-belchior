<?php

namespace App\Http\Controllers;

use App\Models\CitiesGroup;
use Illuminate\Http\Request;

class CitiesGroupController extends Controller
{
    public function all()
    {

    }

    public function insert(Request $request)
    {
        
    }

    public function update(Request $request, $groups_city_id)
    {
        
    }

    public function delete($groups_city_id)
    {
        if(!CitiesGroup::find($groups_city_id))
            return 'Group city product not found.';

        if(CitiesGroup::drop($groups_city_id))
            return 'Group city delete successfuly.';

        return 'Oops! An error ocurred, try again.';
    }
}
