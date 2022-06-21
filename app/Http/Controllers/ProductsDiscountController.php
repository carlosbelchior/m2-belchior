<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Product;
use App\Models\ProductDiscount;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductsDiscountController extends Controller
{
    public function all()
    {
        // Return all campaigns
        return ProductDiscount::with(['product', 'campaign'])->get();
    }

    public function insert(Request $request)
    {
        // Get data post
        $data = $request->all();

        // Validate data post
        $validator = Validator::make($data, [
            'campaign_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'discount' => 'required|numeric',
        ]);
        if($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 400);
        }

        // Check exist campaign and product
        if(!Campaign::where('id', $request->input('campaign_id'))->where('status', 1)->first() || !Product::find($request->input('product_id')))
            return 'Campaign or Product not found.';

        // Checks if the discount is greater than the product price 
        $product_price = Product::find($request->input('product_id'))->price;
        if($request->input('discount') >= $product_price)
            return 'The product cannot have a discount greater than or equal to its value.';

        // Save discount
        $discount = ProductDiscount::create($data);

        // Check save
        if($discount)
            return 'Discount successfuly saved.';

        return 'Oops! An error ocurred, check data and try again.';

    }

    public function update(Request $request, $campaign_id)
    {
        // Check discount exist
        if(!ProductDiscount::find($campaign_id))
            return 'Discount not found.';

        // Remove blank inputs
        if(!array_filter($request->all()))
            return 'Enter at least one of the mandatory parameters';
    
        // Get data post
        $data = $request->all();
        $discount = ProductDiscount::find($campaign_id);

        // Validate data post
        $validator = Validator::make($data, [
            'campaign_id' => 'nullable|numeric',
            'product_id' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
        ]);
        if($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 400);
        }

        // Update discount
        if($discount->update(array_filter($data)))
            return 'Discount successfuly updated.';

        return 'Oops! An error ocurred, check data and try again.';
    }

    public function delete($discount_id)
    {
        // Check city exist
        if(!ProductDiscount::find($discount_id))
            return 'Discount not found.';

        if(ProductDiscount::find($discount_id)->delete())
            return 'Discount delete successfuly.';

        return 'Oops! An error ocurred, try again.';
    }
}