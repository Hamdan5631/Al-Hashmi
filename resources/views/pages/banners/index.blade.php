@extends('layouts.master')
@section('title', 'Banners')
@section('header')
    <div class="mt-3 d-flex justify-content-between align-items-center">
        <h1 class="page-title">Banners</h1>
        <div>
            <a href="{{route('banners.create')}}">
                <button class="btn btn-primary">Add Banner</button>
            </a>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body table-responsive">
            {!! $dataTable->table(['id' => 'banners-table'], true) !!}
        </div>
    </div>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush



