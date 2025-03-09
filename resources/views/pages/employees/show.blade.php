@php use App\Enums\Users\UserStatusEnum; @endphp
@extends('layouts.master')
@section('title', 'Users')
@section('header')
    <div class="d-flex justify-content-between">
        <div>
            <h1 class="page-title">Users</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('employees.index')}}">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$user->name}}</li>
                </ol>
            </nav>
            <ul class="nav nav-tabs mb-3 d-flex justify-content-between align-items-center" role="tablist">
                <div class="d-flex">
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home"
                                aria-selected="true">
                            Details
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-orders" aria-controls="navs-orders"
                                aria-selected="true">
                            Orders
                        </button>
                    </li>
                </div>
            </ul>
        </div>
        <div>
            <button class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#addCoin">
                Add Coins
            </button>
        </div>
    </div>
@endsection

@section('content')
    <div class="tab-content">
        <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="user-avatar-section">
                                <div class=" d-flex align-items-center flex-column">
                                    <img class="img-fluid rounded my-4" src="{{$user->profile_image_url}}" height="110"
                                         width="110" alt="User avatar">
                                    <div class="user-info text-center">
                                        <h4 class="mb-2">{{$user->name}}</h4>
                                    </div>
                                </div>
                            </div>
                            <h5 class="pb-2 border-bottom mb-4">Details</h5>
                            <div class="info-container">
                                <ul class="list-unstyled">
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">Name:</span>
                                        <span>{{$user->name}}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">Email:</span>
                                        <span>{{$user->email}}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">Status:</span>
                                        @if($user->status ===UserStatusEnum::Active->value)
                                            <span class="badge bg-label-success">Active</span>
                                        @endif
                                        @if($user->status ===UserStatusEnum::Blocked->value)
                                            <span class="badge bg-label-danger">Blocked</span>
                                        @endif
                                        @if($user->status ===UserStatusEnum::Deleted->value)
                                            <span class="badge bg-label-warning">Deleted</span>
                                        @endif
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">Contact:</span>
                                        <span>{{$user->mobile_country_code}} {{$user->mobile}}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">Coin Balance:</span>
                                        <span>{{$user->coins}} 🪙</span>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-8 order-1 order-md-0">
                    <div class="card">
                        <div class="card-body bg-grey-100">
                            <h5>User Biddings</h5>
                            <form id="form-users" class="form-inline mb-0">
                                <div class="form-group col-12 align-items-center d-flex">
                                    <div class="col-3">
                                        <label class="sr-only" for="inputUnlabelUsername">Search</label>
                                        <input id="search" type="text" class="form-control" placeholder="Search..."
                                               autocomplete="off">
                                    </div>
                                    <div class="px-4 pt-4">
                                        <button id="btn-filter-admins" type="submit"
                                                class="btn btn-primary btn-outline">
                                            Search
                                        </button>
                                        <a id="btn-clear" class="btn btn-primary ml-2 text-white">Clear</a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-body table-responsive">
                            {!! $dataTable->table(['id' => 'user-biddings-table'], true) !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="tab-pane fade show " id="navs-orders" role="tabpanel">
            <div class="col-12 order-1 order-md-0">
                <div class="card">
                    <h5 class="pb-2 border-bottom mb-4 m-3">Orders</h5>
                    <div class="card-body info-container table-responsive">
                        {!! $userOrdersDatatable->table(['id' => 'user-orders-table'], true) !!}
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('pages.employees._columns._modal.add-coins')
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
    {!! $userOrdersDatatable->scripts() !!}

@endpush

@push('scripts')
    <script>
        $(function () {
            let $table = $('#user-biddings-table');
            $table.on('preXhr.dt', function (e, settings, data) {
                data.filter = {
                    q: $('#search').val(),
                    status: $('#filter-status').val(),
                };
            });

            $('#form-employees').submit(function (e) {
                e.preventDefault();
                $table.DataTable().draw();
            });

            $('#btn-clear').click(function () {
                $('#search').val('');
                $('#filter-status').val();
                $table.DataTable().draw();
            });
        });
    </script>
@endpush

<style>
    #user-orders-table {
        width: 100% !important;
    }
</style>
