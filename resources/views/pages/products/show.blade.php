@php use Carbon\Carbon; @endphp
@php use App\Enums\Products\ProductStatusEnum; @endphp
@extends('layouts.master')
@section('title', 'Products')
@section('header')
    <div class="d-flex justify-content-between">
        <div>
            <h1 class="page-title">Products</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('products.index')}}">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$product->name}}</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="nav-align-top mb-4">
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
                                    data-bs-target="#navs-biddings" aria-controls="navs-biddings"
                                    aria-selected="true">
                                Biddings
                            </button>
                        </li>
                    </div>
                    @if(!$product->is_bidding_started)
                        <div>
                            <a href="{{route('product.bidding-starting',$product->id)}}">
                                <button class="btn btn-primary">Start Bidding</button>
                            </a>
                        </div>
                    @endif
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
                        <div class="col-12 order-1 order-md-0">

                            <h5 class="pb-2 border-bottom mb-4">Details</h5>
                            <div class="info-container">
                                <div class="list-unstyled row">
                                    <div class="col-4 mb-3">
                                        <span class="fw-medium me-2">Name</span>
                                        <div>{{$product->name}}</div>
                                    </div>
                                    @if($product->name_called)
                                        <div class="mb-3 col-4">
                                            <span class="fw-medium me-2">Name Called</span>
                                            <div>{{$product->name_called}}</div>
                                        </div>
                                    @endif
                                    <div class="mb-3 col-4">
                                        <span class="fw-medium me-2">Category</span>
                                        <div>{{$product->category?->name}}</div>
                                    </div>
                                    <li class="col-4 mb-3">
                                        <span class="fw-medium me-2">Description</span>
                                        <div>{{$product->description}}</div>
                                    </li>
                                    <li class="col-4 mb-3">
                                        <span class="fw-medium me-2">Age in Years</span>
                                        <div>{{$product->age_year}}</div>
                                    </li>
                                    <li class="col-4 mb-3">
                                        <span class="fw-medium me-2">Age in Month</span>
                                        <div>{{$product->age_month}}</div>
                                    </li>
                                    <li class="col-4 mb-3">
                                        <span class="fw-medium me-2">Gender</span>
                                        <div>{{$product->gender}}</div>
                                    </li>
                                    <li class="col-4 mb-3">
                                        <span class="fw-medium me-2">Colour</span>
                                        <div>{{$product->colour}}</div>
                                    </li>
                                    <li class="col-4 mb-3">
                                        <span class="fw-medium me-2">Weight</span>
                                        <div>{{$product->weight}} Kg</div>
                                    </li>
                                    <li class="col-4 mb-3">
                                        <span class="fw-medium me-2">Document</span>
                                        @if($product->document_url)
                                        <a target="_blank" href="{{$product->document_url}}">
                                            <div>View File</div>
                                        </a>
                                        @else
                                            <p>No Document</p>
                                        @endif
                                    </li>
                                    <li class="col-4 mb-3">
                                        <span class="fw-medium me-2">Breed</span>
                                        <div>{{$product->breed}}</div>
                                    </li>
                                    <li class="col-4 mb-3">
                                        <span class="fw-medium me-2">Location</span>
                                        <div>{{$product->location}}</div>
                                    </li>
                                    <li class="col-4 mb-3">
                                        <span class="fw-medium me-2">Created Time</span>
                                        <div>{{ Carbon::parse($product->created_at)->format('d-m-Y h:i:s A') }}</div>
                                    </li>
                                    <li class="col-4 mb-3">
                                        <span class="fw-medium me-2">Bidding Time</span>
                                        <div>{{$product->bidding_time}} Minutes</div>
                                    </li>
                                    <li class="col-4 mb-3">
                                        <span class="fw-medium me-2">Bidding Start Time</span>
                                        <div>{{ $product->bidding_start_time ? Carbon::parse($product->bidding_start_time)->format('h.i A - d/m/Y') :"-"}}</div>

                                    </li>
                                    <li class="col-4 mb-3">
                                        <span class="fw-medium me-2">Bidding End Time</span>
                                        <div>{{Carbon::parse($product->bidding_end_time)->format('d-m-Y h:i:s A') }}
                                        </div>
                                    </li>
                                    <li class="col-4 mb-3">
                                        <span class="fw-medium me-2">Price</span>
                                        <div>{{number_format($product->price)}} ₹</div>
                                    </li>
                                    <li class="col-4 mb-3">
                                        <span class="fw-medium me-2">Shipping Charge</span>
                                        <div>{{$product->shipping_charge}} ₹</div>
                                    </li>
                                    <li class="col-4 mb-3">
                                        <span class="fw-medium me-2">Estimated Delivery</span>
                                        <div>{{$product->estimated_delivery}} Day</div>
                                    </li>
                                    <li class="col-4 mb-3">
                                        <span class="fw-medium me-2">Product Returnable</span>
                                        @if($product->is_return_product ==1)
                                            <div>Yes</div>
                                        @else
                                            <div>No</div>
                                        @endif
                                    </li>
                                    <li class="col-4 mb-3">
                                        <span class="fw-medium me-2">Product Vaccinated</span>
                                        @if($product->is_vaccinated ==1)
                                            <div>Yes</div>
                                        @else
                                            <div>No</div>
                                        @endif
                                    </li>
                                    <li class="col-4 mb-3">
                                        <span class="fw-medium me-2">Product Trending</span>
                                        @if($product->is_trending ==1)
                                            <div>Yes</div>
                                        @else
                                            <div>No</div>
                                        @endif
                                    </li>
                                    <li class="col-4 mb-3">
                                        <span class="fw-medium me-2">Product Featured</span>
                                        @if($product->is_featured ==1)
                                            <div>Yes</div>
                                        @else
                                            <div>No</div>
                                        @endif
                                    </li>
                                    <div class="col-4 mb-3">
                                        <div class="fw-medium me-2">Status</div>
                                        @if($product->status ===ProductStatusEnum::Active->value)
                                            <div class="badge bg-label-success">Active</div>
                                        @endif
                                        @if($product->status ===ProductStatusEnum::InActive->value)
                                            <div class="badge bg-label-danger">InActive</div>
                                        @endif
                                        @if($product->status ===ProductStatusEnum::Sold->value)
                                            <div class="badge bg-label-warning">Sold</div>
                                        @endif
                                    </div>

                                </div>
                                @if($product->getProductImages())
                                    <div class="row mt-3">
                                        <h6>Images</h6>
                                        @foreach($product->getProductImages() as $image)
                                            <div class="col-4" style="height:150px;width:150px">
                                                <img src="{{$image}}" alt="product" height="100" width="100"
                                                     style="object-fit: cover;width:100%">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade show " id="navs-biddings" role="tabpanel">
                        <div class="col-12 order-1 order-md-0">

                            <h5 class="pb-2 border-bottom mb-4">Bidding Detail</h5>
                            <div class="info-container table-responsive">
                                {!! $dataTable->table(['id' => 'product-biddings-table'], true) !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush
<style>
    #product-biddings-table {
        width: 100% !important;
    }
</style>
