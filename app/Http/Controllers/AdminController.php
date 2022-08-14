<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){ 
        $data = DB::table('product_categories')
        ->get();
        return view('admin.dashboard',compact('data'));
    }
 


   

}
