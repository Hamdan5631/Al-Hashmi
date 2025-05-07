@extends('layouts.master')
@section('title', 'Expenses')
@section('header')
    <div class="d-flex justify-content-between">
        <div>
            <h1 class="page-title">Add Expense</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('expenses.index')}}">Expense</a></li>
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
                <form action="{{route('expenses.store')}}" id="product-create-form" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Title*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name"
                                   placeholder="Enter name" value="{{old('name')}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Category*</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="category">
                                <option value="">Choose Category</option>
                                <option value="TOOLS">Tools</option>
                                <option value="OTHER">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Description</label>
                        <div class="col-sm-10">
                            <textarea type="text" class="form-control" name="description" id="description"
                                      placeholder="Enter the description"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Amount*</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="amount" id="amount"
                                   placeholder="Enter the amount" value="{{old('amount')}}">
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
        $('#product-create-form').validate({
            rules: {
                name: {
                    required: true
                },
                category: {
                    required: true
                },
                amount: {
                    required: true
                },
            }
        })
    </script>
@endpush
