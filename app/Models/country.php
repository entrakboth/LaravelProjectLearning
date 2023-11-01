<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    use HasFactory;
    protected $table = "countries";

    // get all state belong to
    public function data(){
        return $this->hasMany(State::class,'countryId');
    }
}
