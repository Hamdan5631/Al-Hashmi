<div class="modal fade" id="quantityChange" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Quantity</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  class="quantity-change-form" action="{{route('sold-product')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="quantity" class="col-form-label">Quantity*</label>
                        <input type="number" min="1" class="form-control" id="quantity" name="quantity"  value="{{old('quantity')}}">
                    </div>
                    <div class="mb-3">
                        <label for="selling_price" class="col-form-label">Selling price (AED)*</label>
                        <input type="number" class="form-control" id="selling_price" name="selling_price"
                        value="{{old('selling_price')}}">
                    </div>
                    <input type="hidden" name="id" id="product_id">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(function () {
            $('.quantity-change-form').validate({
                rules: {
                    quantity: {
                        required: true
                    },

                    selling_price: {
                        required: true
                    },
                }
            })
        })
    </script>
@endpush
