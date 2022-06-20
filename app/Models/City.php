<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\CitiesGroup;

class City extends Model
{
    use HasFactory;
    protected $table = 'cities';
    protected $fillable = ['name', 'group_id'];

    public function groups()
    {
        return $this->belongsToMany(Group::class, CitiesGroup::class, 'city_id', 'group_id');
    }
}