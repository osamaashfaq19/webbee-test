<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Workshop extends Model
{

    function scopeStart($query){
        return $query->where('start', '>',date("Y-m-d H:i:s"));
    }
}
