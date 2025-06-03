@php
    $admin = \App\Models\Admin::query()->findOrFail(Auth::id());
@endphp

@if($admin->isSuperAdmin())
    <div class="d-flex text-right">
        <a href="{{ route('stocks.edit', $id) }}" class=" btn btn-sm btn-icon btn-pure btn-default"
           data-toggle="tooltip" data-original-title="Edit" title="Edit" data-plugin="ladda" data-style="zoom-in">
            <span class="ladda-label"><i class="bx bx-edit pl-5" aria-hidden="true"></i></span>
        </a>
        <a href="javascript:void(0);"
           class="btn btn-sm btn-icon btn-pure btn-default ladda-button btn-delete"
           data-toggle="tooltip"
           data-original-title="Delete"
           title="Delete"
           data-url="{{ route('stocks.destroy', $id) }}">
            <span class="ladda-label"><i class="bx bx-trash" aria-hidden="true"></i></span>
        </a>


    </div>
@endif

@if($admin->isEmployee() && $model->status != \App\Enums\ProductStatusEnum::OUT_OF_STOCK->value)
    <button type="button" class="btn btn-primary sell-btn" data-bs-toggle="modal"
            data-bs-target="#quantityChange" data-id="{{$id}}" data-price="{{$sold_price}}">
        Sell
    </button>

@endif
