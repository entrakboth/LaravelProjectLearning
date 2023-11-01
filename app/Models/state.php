<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class state extends Model
{
    use HasFactory;
    protected $table = ("states");

    // get country
    public function getCountry(){
        return $this->belongsTo(country::class,'countryId','id');
    }
}
