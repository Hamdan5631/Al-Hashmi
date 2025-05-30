@php use App\Enums\Users\UserStatusEnum; @endphp
@extends('layouts.master')
@section('title', 'Employees')
@section('header')
    <div class="d-flex justify-content-between">
        <div>
            <h1 class="page-title">Users</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('employees.index')}}">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$employee->name}}</li>
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
                            Sold Stocks
                        </button>
                    </li>
                </div>
            </ul>
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
                                    <img class="img-fluid rounded my-4" src="{{$employee->profile_image_url}}" height="110"
                                         width="110" alt="User avatar">
                                    <div class="user-info text-center">
                                        <h4 class="mb-2">{{$employee->name}}</h4>
                                    </div>
                                </div>
                            </div>
                            <h5 class="pb-2 border-bottom mb-4">Details</h5>
                            <div class="info-container">
                                <ul class="list-unstyled">
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">Name:</span>
                                        <span>{{$employee->name}}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">Email:</span>
                                        <span>{{$employee->email}}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">Status:</span>
                                        @if($employee->status ===UserStatusEnum::Active->value)
                                            <span class="badge bg-label-success">Active</span>
                                        @endif
                                        @if($employee->status ===UserStatusEnum::Blocked->value)
                                            <span class="badge bg-label-danger">Blocked</span>
                                        @endif
                                        @if($employee->status ===UserStatusEnum::Deleted->value)
                                            <span class="badge bg-label-warning">Deleted</span>
                                        @endif
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">Contact:</span>
                                        <span>{{$employee->mobile_country_code}} {{$employee->mobile}}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">Total Sales (AED):</span>
                                        <span>{{$employee->totalSales()}}</span>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="tab-pane fade show " id="navs-orders" role="tabpanel">
            <div class="col-12 order-1 order-md-0">
                <div class="card">
                    <h5 class="pb-2 border-bottom mb-4 m-3">Sold Stocks</h5>
                    <div class="card-body info-container table-responsive">
                        {!! $dataTable->table([
                            'id' => 'sold-stocks-table',
                            'style' => 'width: 100%;'
                        ], true) !!}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush

@push('scripts')
    <script>
        $(function () {
            let $table = $('#sold-stocks-table');
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
