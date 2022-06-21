<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function all()
    {
        // Return all products
        return Product::all();
    }

    public function insert(Request $request)
    {
        // Get data post
        $data = $request->all();

        // Check campaign exist
        if($request->campaign_id && !Campaign::find($request->campaign_id))
            return 'Campaign not found.';
        
        // Validate data post
        $validator = Validator::make($data, [
            'name' => 'required|min:3',
            'price' => 'required|numeric'
        ]);
        if($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 400);
        }
        
        // Save product
        $product = Product::create($data);

        // Check save
        if($product)
            return 'Product successfuly saved.';

        return 'Oops! An error ocurred, check data and try again.';

    }

    public function update(Request $request, $product_id)
    {
        // Check product exist
        if(!Product::find($product_id))
            return 'Product not found.';

        // Remove blank inputs
        if(!array_filter($request->all()))
            return 'Enter at least one of the mandatory parameters';
            
        // Get data post
        $data = $request->all();
        $product = Product::find($product_id);

        // Check campaign exist
        if($request->campaign_id && !Campaign::find($request->campaign_id))
            return 'Campaign not found.';

        // Validate data post
        $validator = Validator::make($data, [
            'name' => 'nullable|min:3',
            'price' => 'nullable|numeric'
        ]);
        if($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 400);
        }

        if($product->update(array_filter($data)))
            return 'Product successfuly updated.';

        return 'Oops! An error ocurred, check data and try again.';
    }

    public function delete($product_id)
    {
        if(!Product::find($product_id))
            return 'Product not found.';

        if(Product::find($product_id)->delete())
            return 'Product delete successfuly.';

        return 'Oops! An error ocurred, try again.';
    }
}
