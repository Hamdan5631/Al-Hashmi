@extends('layouts.master')
@section('title', 'Banners')
@section('header')
    <div class="d-flex justify-content-between">
        <div>
            <h1 class="page-title">Edit Banner</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('banners.index')}}">Banners</a></li>
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
                <form action="{{route('banners.update',$banner->id)}}" id="banner-create-form" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Image*</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control mb-3" name="image" id="image"
                                   placeholder="Enter name" value="{{old('image')}}">
                            <img src="{{asset($banner->image_url)}}" height="50" width="50">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Status*</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="is_active">
                                <option disabled>Choose Status</option>
                                <option @selected($banner->is_active==1) value="1">Active</option>
                                <option @selected($banner->is_active==0) value="0">InActive</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Store banner</label>
                        <div class="col-sm-10">
                            <div class="form-check d-flex">
                                <input name="is_store_banner" class="form-check-input" type="checkbox" value="1"
                                       id="male_check" @checked($banner->is_store_banner === 1)>

                            </div>
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
        $('#banner-create-form').validate({
            rules: {
                image: {
                    accept: "image/jpeg, image/png, image/jpg, image/gif"
                },
                status: {
                    required: true
                },
            }
        })
    </script>
@endpush
