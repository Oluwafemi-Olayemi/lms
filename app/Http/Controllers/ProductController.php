<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>  'required',
            'description' => 'required',
            'cost' => 'required',
            'category' => 'required',
            'quantity' => 'required',
            'prod_imgs' => 'required',
        ]);
$path=[];
        if ($request->file('prod_imgs')){
            foreach($request->file('prod_imgs') as $key => $file)
            {
                $p = Storage::putFile('uploads/products', $file);
                array_push($path, $p);
            }
        }




        $product = new Product();
        $product->name = $request->input('name');
        $product->desc = $request->input('description');
        $product->cost = $request->input('cost');
        $product->cat_id = $request->input('category');
        $product->quantity = $request->input('quantity');
        $product->img = json_encode($path);
        $product->save();

        return redirect()->route('cat_and_prod','#product')
            ->with('status', '"'.request()->input('name').'"'.' product created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
