<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['name', 'price', 'campaign_id'];

    public function discount()
    {
        return $this->hasOne(ProductDiscount::class, 'id', 'product_id');
    }

    public function discount_picot()
    {
        return $this->belongsToMany(Campaign::class, ProductDiscount::class, 'product_id', 'campaign_id');
    }
}