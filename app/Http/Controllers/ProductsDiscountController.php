<?php

namespace App\Http\Controllers;

use App\Models\ProductDiscount;
use Illuminate\Http\Request;

class ProductsDiscountController extends Controller
{
    public function all()
    {

    }

    public function insert(Request $request)
    {
        
    }

    public function update(Request $request, $discount_id)
    {
        
    }

    public function delete($discount_id)
    {
        if(!ProductDiscount::find($discount_id))
            return 'Discount product not found.';

        if(ProductDiscount::drop($discount_id))
            return 'Discount product delete successfuly.';

        return 'Oops! An error ocurred, try again.';
    }
}
