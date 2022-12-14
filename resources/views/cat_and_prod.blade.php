@extends('adminlte::page')

@section('title', 'Cat&Prod')

@section('content_header')
    <h1>Category and Product</h1>
@stop
@section('plugins.BootstrapSelect', true)
@section('plugins.BsCustomFileInput', true)
@section('plugins.Datatables', true)

@section('content')
    @if (session('status'))
        <x-adminlte-callout theme="success" title="Success">
            {{ session('status') }}
        </x-adminlte-callout>
    @endif


    <div class="card">
        <div class="card-body">
            <form action="/category/create" method="post">
                @csrf
                <fieldset class="border p-2">
                    <legend class="float-none w-auto p-2 mb-0">Category</legend>
                    <div class="row  mb-3">
                        <x-adminlte-input name="name" label="Category Name" placeholder="category name"
                                          fgroup-class="col-md-6 mb-0" disable-feedback/>

                        <div class="col-md-6 mb-0 align-self-end">
                            <x-adminlte-button class="btn-flat h-50" type="submit" label="create"
                                               theme="success" icon="fas fa-lg"/>
                        </div>


                    </div>
                </fieldset>
            </form>
            @php
                $cat_heads = [
                        'ID',
                        'Name',
                        ['label' => 'Actions', 'no-export' => true, 'width' => 5],
                        ];
        $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </button>';
        $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                          <i class="fa fa-lg fa-fw fa-trash"></i>
                      </button>';

        $categories = \App\Models\Category::where('name', '!=', 'uncategorized')->select(['id','name'])->get();

        $data=[];
            foreach ($categories as $key=>$item) {
                 array_push($data, [$key+1,$item->name,'<nobr>'.$btnEdit.$btnDelete.'</nobr>']);
            }


            $config = [
            'data' => $data,
            'order' => [[1, 'asc']],
            'columns' => [null, null, ['orderable' => false]],
        ];
            @endphp
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                View/Delete Category List
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <x-adminlte-datatable id="table1" :heads="$cat_heads"  hoverable>
                                @foreach($config['data'] as $row)
                                    <tr>
                                        @foreach($row as $cell)
                                            <td>{!! $cell !!}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </x-adminlte-datatable>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <form action="/products" method="post" enctype="multipart/form-data">
        @csrf
        <fieldset class="border p-2" id="product">
            <legend class="float-none w-auto p-2 mb-0">Product</legend>
            <div class="row  mb-3">
                <x-adminlte-input name="name" label="Product Name" placeholder="product name"
                                  fgroup-class="col-md-6 mb-0"/>
                <x-adminlte-input name="description" label="Product description" placeholder="product description"
                                  fgroup-class="col-md-6 mb-0"/>
            </div>

            <div class="row  mb-3">
                <x-adminlte-input name="cost" label="Product cost" placeholder="product cost"
                                  fgroup-class="col-md-6 mb-0"/>
                <x-adminlte-select-bs name="category" label="Category" fgroup-class="col-md-6 mb-0">
                    @php
                    foreach($categories as $category){

                        echo('<option value="'.$category->id.'">'.$category->name.'</option>');
                    }
                    @endphp
                </x-adminlte-select-bs>
            </div>

            <div class="row mb-3">
                <x-adminlte-input name="quantity" label="Product quantity" placeholder="product quantity"
                                  fgroup-class="col-md-6 mb-0"/>

                <x-adminlte-input-file id="prod_imgs" name="prod_imgs[]" label="Upload Product images"
                                       fgroup-class="col-md-6 mb-0"
                                       placeholder="Choose multiple files..." igroup-size="md" legend="Choose" multiple>

                    <x-slot name="prependSlot">
                        <div class="input-group-text text-primary">
                            <i class="fas fa-file-upload"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input-file>
            </div>

            <x-adminlte-button class="btn-flat h-50" type="submit" label="create"
                               theme="success" icon="fas fa-lg"/>


        </fieldset>
    </form>

    @php
        $prod_heads = [
                'ID',
                'Name',
                'Cost',
                'Quantity',
                ['label' => 'Actions', 'no-export' => true, 'width' => 5],
                ];
$btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </button>';
$btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </button>';
$btnView = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="View">
                  <i class="fa fa-lg fa-fw fa-eye"></i>
              </button>';



$products = \App\Models\Product::with("category")->where('id', \Auth::id())->select(['name','cost','quantity'])->get();

$data=[];
    foreach ($products as $key=>$item) {
         array_push($data, [$key+1,$item->name,$item->quantity,$item->cost,'<nobr>'.$btnEdit.$btnDelete.$btnView.'</nobr>']);
    }

    $config2 = [
    'data' => $data,
    'order' => [[1, 'asc']],
    'columns' => [null, null, ['orderable' => false]],
];
    @endphp
    <div class="accordion" id="accordionExample2">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        View/Edit/Delete Product List
                    </button>
                </h2>
            </div>

            <div id="collapseTwo" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordionExample2">
                <div class="card-body">
                    <x-adminlte-datatable id="table2" :heads="$prod_heads"  hoverable>
                        @foreach($config2['data'] as $row)
                            <tr>
                                @foreach($row as $cell)
                                    <td>{!! $cell !!}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </x-adminlte-datatable>
                </div>
            </div>
        </div>

    </div>

@stop

@section('css')
    {{--    <link rel="stylesheet" href="/css/admin_custom.css">--}}
@stop

@section('js')
    {{--    <script> console.log('Hi!'); </script>--}}
@stop
