<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kingdom extends Model
{
    use HasFactory;
    protected $table = "kingdoms";

    public function getCities(){
        return $this->hasMany(cities::class, 'KingdomsId', 'id');
    }

}
