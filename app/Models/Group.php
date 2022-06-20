<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $table = 'groups';
    protected $fillable = ['name', 'campaign_id'];

    public function campaign()
    {
        return $this->hasOne(Campaign::class, 'id', 'campaign_id');
    }
}
