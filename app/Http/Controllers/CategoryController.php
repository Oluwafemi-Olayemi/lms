<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        //@todo paginate data

        return view('cat_and_prod');

    }
    public function createCategory(){
        request()->validate(
            [
                'name' => 'required|max:50|unique:categories'
            ]
        );

        $category = new Category();
        $category->name = request()->input('name');
        $category->user_id = \Auth::id();
        $category->save();

        return back()->with('status', '"'.request()->input('name').'"'.' category created successfully');

    }
}
