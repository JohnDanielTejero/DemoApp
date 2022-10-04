<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index(){

        //raw query
        $users = DB::select('select * from users where email = ?', ['johndanieltejero23@gmail.com']);
        //dd($users);

        //query builder
        //$userss = DB::table('users')->select(['name','email'])->whereNotNull('email')->orderBy('name')->get();
        //$userss = DB::table('users')->select(['email', 'name'])->where('name', 'daniel')->get();
        //dd($userss);
        //return view('homepage');

        //eloquent
        //$usersss = User::all();
        $usersss = User::where('name','daniel')->get();
        dd($usersss);
    }
}
