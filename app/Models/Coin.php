<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    use HasFactory;
    protected $fillable = ['Title', 'Qty' , 'Prices'];
    protected $guarded = ["id"];

    // after ind id on coin table
    // we used Category becuase we need data from that table
    // find "type" column in Category with "spell_type" in Coin table
    public function getall(){
        return $this->hasMany(Category::class,'type','spell_type');
    }
}
