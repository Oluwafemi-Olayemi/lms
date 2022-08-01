<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class SideMenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile(){
        $company = Company::where('user_id',\Auth::id())->first();


        return view("profile", compact('company'));
    }

}
