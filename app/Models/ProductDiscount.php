<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDiscount extends Model
{
    use HasFactory;
    protected $table = 'products_discount';
    protected $fillable = ['product_id', 'campaign_id', 'discount'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }
}
