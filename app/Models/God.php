<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class God extends Model
{
    use HasFactory;
    protected $table = "gods";

    public function getRank(){
        return $this->hasOne(rank::class, 'id','id');
    }
}
