<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function all()
    {

    }

    public function insert(Request $request)
    {
        
    }

    public function update(Request $request, $product_id)
    {
        
    }

    public function delete($product_id)
    {
        if(!Product::find($product_id))
            return 'Product product not found.';

        if(Product::drop($product_id))
            return 'Product delete successfuly.';

        return 'Oops! An error ocurred, try again.';
    }
}
