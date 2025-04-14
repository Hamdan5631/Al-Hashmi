@extends('layouts.master')
@section('title', 'Products')
@section('header')
    <div class="d-flex justify-content-between">
        <div>
            <h1 class="page-title">Edit Stock</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('stocks.index')}}">Products/ {{$stock->name}}</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
@endsection
@section('content')
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
            </div>
            <div class="card-body">
                <form action="{{route('stocks.update',$stock->id)}}" id="product-create-form"
                      enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    @php
                        $admin = \App\Models\Admin::findOrFail(\Illuminate\Support\Facades\Auth::id());
                    @endphp

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Name*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name"
                                   placeholder="Enter name" value="{{old('name',$stock->name)}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Category*</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" data-plugin="select2" name="category_id" id="category_id">
                                <option value="" selected>Choose Category</option>
                                @foreach($categories as $category)
                                    <option @selected($category->id == $stock->category_id) value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Description</label>
                        <div class="col-sm-10">
                            <textarea type="text" class="form-control" name="description" id="description"
                                      placeholder="Enter the description">{{old('description',$stock->description)}}</textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Image<span
                                style="opacity: 70%"></span>*</label>
                        <div class="col-sm-10">
                            <input type="file" name="images" class="form-control" multiple>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Quantity
                        </label>
                        <div class="col-sm-10">
                            <input type="number" name="quantity" value="{{old('quantity',$stock->quantity)}}"
                                   class="form-control" placeholder="Enter the quantity">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Actual Price
                            <span style="font-size: 11px">(AED)</span></label>
                        <div class="col-sm-10">
                            <input type="number" name="actual_price"
                                   value="{{old('actual_price',$stock->actual_price)}}"
                                   class="form-control" placeholder="Enter the actual price">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Selling Price
                            <span style="font-size: 11px">(AED)</span>
                        </label>
                        <div class="col-sm-10">
                            <input type="number" name="sold_price" value="{{old('sold_price',$stock->sold_price)}}"
                                   class="form-control" placeholder="Enter the selling price">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Status*
                        </label>
                        <div class="col-sm-10">
                            <select class="form-control select2" data-plugin="select2" name="status" id="status">
                                @foreach(\App\Enums\ProductStatusEnum::cases() as $status)
                                    <option
                                        @selected($status->value == $stock->status) value="{{$status->value}}">{{str_replace('_',' ',\Illuminate\Support\Str::title($status->value))}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(function () {

            $('#product-create-form').validate({
                    rules: {
                        name: {
                            required: true
                        },
                        quantity: {
                            required: true,
                            min:1
                        },
                    }
            })
        })

    </script>
@endpush
