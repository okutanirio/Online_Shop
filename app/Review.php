<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['product_id', 'name', 'evaluation', 'comment', 'created_at', 'updated_at'];
}
