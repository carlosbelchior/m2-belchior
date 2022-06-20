<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = 'cities';
    protected $fillable = ['name', 'group_id'];

    public function group()
    {
        return $this->hasOne(Group::class, 'id', 'group_id');
    }
}