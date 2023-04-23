<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\product;
use App\productuser;

class UserController extends Controller
{
    public function index($id)
    {
        $user = new User;

        $user_id = auth()->user()->id;
        $name = auth()->user()->name;
        $email = auth()->user()->email;
        
                
        return view('users.index', [
            'user_id' => $user_id, 
            'name' => $name, 
            'email' => $email, 
        ]);
    }

    public function purchaselist() {
        $productuser = new productuser;
        $product = new product;
        $userid = auth()->user()->id;

        $products = $product->all()->toArray();
        $productusers = $productuser->all()->toArray();

        $a = 0;
        foreach($products as $product) {
            foreach($productusers as $productuser) {
                if($userid == $productuser['user_id']) {
                    if($productuser['product_id'] == $product['id']) {
                        if($productuser['status'] == 1) {
                            $a = 1;
                        }
                    }
                }
            }
        }
                
        return view('/users/purchase_history', [
            'a' => $a, 
            'products' => $products, 
            'productusers' => $productusers, 
            'userid' => $userid, 
        ]);
    }

    public function edit($id)
    {
        //編集ページの表示
        $user = auth()->user();

        return view('users.edit_user', [
            'user' => $user, 
        ]);
    }

    public function update(Request $request) {
        //編集処理

        $user = new User;
        $user = auth()->user();
        $user->where('id', $user['id'])->update(['name' => $request->name]);
        $user->where('id', $user['id'])->update(['email' => $request->email]);


        return redirect()->route('mypage',['id' => $user['id']]);
    }
}
