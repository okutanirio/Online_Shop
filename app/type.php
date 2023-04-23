<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class type extends Model
{

    public function getLists() {
        $categorys = type::pluck('name', 'id');

        return $categorys;
    }
    public function products() {
        return $this->hasMany('app\product');
    }
}
