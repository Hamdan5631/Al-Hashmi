@extends('layouts.master')
@section('title', 'Users')
@section('header')
    <div class="mt-3 d-flex justify-content-between align-items-center">
        <h1 class="page-title">Employees</h1>
        <a href="{{route('employees.create')}}">
        <div>
            <button class="btn btn-primary">Create</button>
        </div>
        </a>
    </div>
@endsection
@section('content')

    <div class="card">
        <div class="card-body bg-grey-100">
            <form id="form-employees" class="form-inline mb-0">
                <div class="form-group col-12 align-items-center d-flex flex-wrap">
                    <div class="col-3">
                        <label class="sr-only" for="inputUnlabelUsername">Search</label>
                        <input id="search" type="text" class="form-control" placeholder="Search..." autocomplete="off">
                    </div>

                    <div class="mx-3 pt-4">
                        <button id="btn-filter-admins" type="submit" class="btn btn-primary btn-outline">Search</button>
                        <a id="btn-clear" class="btn btn-primary ml-2 text-white">Clear</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body table-responsive">
            {!! $dataTable->table(['id' => 'employees-table'], true) !!}
        </div>
    </div>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush

@push('scripts')
    <script>
        $(function () {
            let $table = $('#employees-table');
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
                $('#filter-status').val('');
                $table.DataTable().draw();
            });

            $table.on('click', '.status-change', function (e) {
                e.preventDefault();
                let ladda = Ladda.create(this);
                let url = $(this).attr('href');
                alertify.okBtn("Block")
                alertify.confirm("Do you want to Block User?", function () {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        }
                    }).done(function (data, textStatus, jqXHR) {
                        toastr.success(data?.data)
                        $table.DataTable().draw();
                    }).fail(function (jqXHR, textStatus, errorThrown) {

                    }).always(function () {
                        ladda.stop();
                    });
                }, function () {
                    ladda.stop();
                });
            });

        });
    </script>
@endpush

