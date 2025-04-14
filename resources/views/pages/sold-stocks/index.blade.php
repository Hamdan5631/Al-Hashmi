@extends('layouts.master')
@section('title', 'Stocks')
@section('header')
    @php
        $admin = \App\Models\Admin::find(Auth::id());
    @endphp
    <div class="mt-3 d-flex justify-content-between align-items-center">
        <h1 class="page-title">Sold Stocks</h1>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body bg-grey-100">
            <form id="form-sold-stocks" class="form-inline mb-0">
                <div class="form-group col-12 align-items-center d-flex">
                    <div class="col-3">
                        <label class="sr-only" for="inputUnlabelUsername">Search</label>
                        <input id="search" type="text" class="form-control" placeholder="Search..." autocomplete="off">
                    </div>
                    <div class="form-group px-3 col-2">
                        <label class="m-10" for="filter-status">Employees</label>
                        <select class="form-control select2" data-plugin="select2" name="employee_id" id="employee_id">
                            <option value="" selected>Choose Employee</option>
                            @foreach($employees as $employee)
                                <option value="{{$employee->id}}">{{$employee->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="px-4 pt-4">
                        <button id="btn-filter-admins" type="submit" class="btn btn-primary btn-outline">Search</button>
                        <a id="btn-clear" class="btn btn-primary ml-2 text-white">Clear</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body table-responsive">
            {!! $dataTable->table(['id' => 'products-table'], true) !!}
        </div>
    </div>
    @include('pages.products.columns.quantity-change')
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush

@push('scripts')
    <script>
        $(function () {
            let $table = $('#products-table');
            $table.on('preXhr.dt', function (e, settings, data) {
                data.filter = {
                    q: $('#search').val(),
                    employee: $('#employee_id').val(),
                };
            });

            $('#form-sold-stocks').submit(function (e) {
                e.preventDefault();
                $table.DataTable().draw();
            });

            $('#btn-clear').click(function () {
                $('#search').val('');
                $('#employee_id').val('').trigger('change');
                $table.DataTable().draw();
            });

        });
    </script>
@endpush

