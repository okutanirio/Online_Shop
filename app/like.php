<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function like_exist($user_id, $product_id) {        
        return Like::where('user_id', $user_id)->where('product_id', $product_id)->exists();       
    }
}
