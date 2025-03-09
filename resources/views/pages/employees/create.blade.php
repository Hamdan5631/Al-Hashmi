@extends('layouts.master')
@section('title', 'Products')
@section('header')
    <div class="d-flex justify-content-between">
        <div>
            <h1 class="page-title">Add Employee</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('employees.index')}}">Employees</a></li>
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
                <form action="{{route('employees.store')}}" id="product-create-form" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Name*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name"
                                   placeholder="Enter name" value="{{old('name')}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Email*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" id="email"
                                   placeholder="Enter email" value="{{old('email')}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Mobile</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="mobile" id="email"
                                   placeholder="Enter mobile number" value="{{old('mobile')}}">
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
                email: {
                    required: true
                },
            }
        })
    </script>
@endpush
