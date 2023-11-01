<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cities extends Model
{
    use HasFactory;
    protected $table = "cities";
    protected $guarded = ["id"];


    public function getKingdoms(){
        return $this->belongsTo(kingdom::class,'KingdomsId');
    }

}
