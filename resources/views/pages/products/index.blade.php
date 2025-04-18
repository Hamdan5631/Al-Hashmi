@extends('layouts.master')
@section('title', 'Stocks')
@section('header')
    @php
        $admin = \App\Models\Admin::find(Auth::id());
    @endphp
    <div class="mt-3 d-flex justify-content-between align-items-center">
        <h1 class="page-title">Stocks</h1>
        @if($admin->isSuperAdmin())
            <div>
                <a href="{{route('stocks.create')}}">
                    <button class="btn btn-primary">Add Stock</button>
                </a>
            </div>
        @endif
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body bg-grey-100">
            <form id="form-stocks" class="form-inline mb-0">
                <div class="form-group col-12 align-items-center d-flex">
                    <div class="col-3">
                        <label class="sr-only" for="inputUnlabelUsername">Search</label>
                        <input id="search" type="text" class="form-control" placeholder="Search..." autocomplete="off">
                    </div>
                    <div class="form-group px-3 col-2">
                        <label class="m-10" for="filter-status">Status</label>
                        <select id="filter-status" class="form-control select2" data-plugin="select2">
                            <option value="" selected>All</option>
                            @foreach(\App\Enums\ProductStatusEnum::cases() as $status)
                                <option value="{{$status->value}}">
                                    {{str_replace('_', ' ',\Illuminate\Support\Str::title($status->name))}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group px-3 col-2">
                        <label class="m-10" for="filter-status">Category</label>
                        <select class="form-control select2" data-plugin="select2" name="category_id" id="category_id">
                            <option value="" selected>Choose Category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
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
    @foreach ($errors->all() as $error)
        @if($error)
            <script>
                toastr.error("{{$error}}")
                $('#quantityChange').modal('show')
            </script>
        @endif

    @endforeach
    <script>
        $(function () {
            let $table = $('#products-table');
            $table.on('preXhr.dt', function (e, settings, data) {
                data.filter = {
                    q: $('#search').val(),
                    status: $('#filter-status').val(),
                    category: $('#category_id').val(),
                };
            });

            $('#form-stocks').submit(function (e) {
                e.preventDefault();
                $table.DataTable().draw();
            });

            $('#btn-clear').click(function () {
                $('#search').val('');
                $('#filter-status').val('').trigger('change');
                $('#category_id').val('').trigger('change');
                $table.DataTable().draw();
            });

            $table.on('click', '.btn-delete', function (e) {
                e.preventDefault();
                const deleteUrl = $(this).data('url');

                alertify.confirm(
                    "Are you sure you want to delete this stock?",
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
                                    alertify.success("Deleted successfully");
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
        $(document).ready(function () {
            $(document).on('click', '.sell-btn', function () {
                let id = $(this).data('id');

                $('#product_id').val(id);

            });
        });


    </script>
@endpush
<style>
    .modal-open .select2-container {
        z-index: 0 !important;
    }
</style>
