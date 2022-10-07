<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Event extends Model
{
    protected $table = 'events'; 
    
    function workshop(){
        return $this->hasMany(Workshop::class,'event_id')->start(); 
    }
    
    function scopeStarted($query){
        return $query->where('created_at', '>',Carbon::now()); 
    }

}
