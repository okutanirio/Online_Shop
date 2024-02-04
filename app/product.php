<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = ['name', 'price', 'type_id', 'info', 'description', 'image'];
    
    public function type() {
        return $this->belongsTo('app\type', 'type_id', 'id');
    }

    public function likes() {
        return $this->hasMany('App\Like');
    }


}
