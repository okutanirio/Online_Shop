<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productuser extends Model
{
    protected $fillable = ['user_id', 'product_id', 'status'];
    
}
