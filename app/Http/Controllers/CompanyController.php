<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;


class CompanyController extends Controller
{

    public function coyProfile(Request $request)
    {
        $company = $request->validate([
            'name' => 'required|max:255',
            'logo' => 'required',
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'description' => 'required'
        ]);

//@todo create file insert logic
//@todo creating a company record doesn't solve the case scenario of multiple company for a user
        $company = Company::create([
            'name' => $company['name'],
            'description'=> $company['description'],
            'address'=> $company['address'],
            'phone'=> $company['phone'],
            'email'=> $company['email'],
            'map_location'=> $company['map_location'] ?? null,
            'user_id'=> \Auth::id()
        ]);
//check middleware and return as appropriate
        return back();

    }


}
