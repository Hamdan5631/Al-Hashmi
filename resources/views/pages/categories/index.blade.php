@extends('layouts.master')
@section('title', 'Categories')
@section('header')
    <div class="mt-3 d-flex justify-content-between align-items-center">
        <h1 class="page-title">Categories</h1>
        <a href="{{route('categories.create')}}">
        <div>
            <button class="btn btn-primary">Create</button>
        </div>
        </a>
    </div>
@endsection
@section('content')

    <div class="card">
        <div class="card-body bg-grey-100">
            <form id="form-categories" class="form-inline mb-0">
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
            {!! $dataTable->table(['id' => 'categories-table'], true) !!}
        </div>
    </div>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush

@push('scripts')
    <script>
        $(function () {
            let $table = $('#categories-table');
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
            $table.on('click', '.btn-delete', function (e) {
                e.preventDefault();
                const deleteUrl = $(this).data('url');

                alertify.confirm(
                    "Are you sure you want to delete this category?",
                    function (e) {
                        if (e) {
                            // User clicked "OK"
                            $.ajax({
                                url: deleteUrl,
                                type: 'POST',
                                data: {
                                    _method: 'DELETE',
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function () {
                                    // alertify.success("Deleted successfully");
                                    $table.DataTable().ajax.reload(null, false);
                                },
                                error: function () {
                                    alertify.error("Delete failed");
                                }
                            });
                        } else {
                            // User clicked "Cancel"
                            alertify.error("Delete cancelled");
                        }
                    }
                );

            });


        });
    </script>
@endpush

