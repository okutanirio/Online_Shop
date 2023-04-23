<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection\paginate;

use App\User;

class AdminController extends Controller
{
    public function index()
    {
        $user = new User;

        $all = $user->orderBy('created_at')->paginate(10);
        
        return view('admins.index', [
            'users' => $all, 
        ]);
    }
}
