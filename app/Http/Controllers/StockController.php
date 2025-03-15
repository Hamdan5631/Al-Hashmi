<?php

namespace App\Http\Controllers;

use App\DataTables\StocksDataTable;
use App\Enums\ProductStatusEnum;
use App\Http\Requests\StoreProductRequest;
use App\Models\Admin;
use App\Models\Product;
use App\Models\SoldProduct;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class StockController extends Controller
{
    public function index(StocksDataTable $dataTable)
    {
        return $dataTable->render('pages.products.index');
    }

    public function create(): View|RedirectResponse
    {
        $admin = Admin::find(Auth::id());

        if ($admin->isEmployee()) {
            return abort(403);
        }

        return view('pages.products.create');
    }

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $product = new Product();
        $product->name = $request->get('name');
        $product->description = $request->get('description');
        $product->actual_price = $request->get('actual_price');
        $product->sold_price = $request->get('sold_price');
        $product->quantity = $request->get('quantity');
        $product->status = $request->get('status');
        $product->save();

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $originalName = preg_replace('/[^\w.-]/', '_', $image->getClientOriginalName());
            $imageName = time() . '_' . $originalName;

            $path = $image->storeAs('product-images', $imageName, 'public');

            $product->image = $path;
            $product->save();
        }


        return redirect()
            ->route('stocks.index')
            ->with('success', 'Stock Added Successfully');
    }

    public function edit(Product $stock): View|RedirectResponse
    {
        $admin = Admin::find(Auth::id());

        if($admin->isEmployee()){
            return abort(403);
        }

        return view('pages.products.edit', compact('stock'));
    }

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function update(Request $request, Product $stock): RedirectResponse
    {
        $stock->name = $request->get('name');
        $stock->description = $request->get('description');
        $stock->actual_price = $request->get('actual_price');
        $stock->sold_price = $request->get('sold_price');
        $stock->quantity = $request->get('quantity');
        $stock->status = $request->get('status');
        $stock->save();

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $originalName = preg_replace('/[^\w.-]/', '_', $image->getClientOriginalName());
            $imageName = time() . '_' . $originalName;

            if ($stock->image && Storage::disk('public')->exists($stock->image)) {
                Storage::disk('public')->delete($stock->image);
            }

            $path = $image->storeAs('product-images', $imageName, 'public');

            $stock->image = $path;
            $stock->save();
        }

        return redirect()
            ->route('stocks.index')
            ->with('success', 'Product Updated Successfully');
    }

    public function destroy(Product $stock): JsonResponse
    {
        $stock->delete();
        return response()->json(['message' => 'Product Deleted Successfully']);
    }

    public function soldProduct(Request $request): RedirectResponse
    {
        $product = Product::findOrFail($request->get('id'));

        $quantityToSell = (int)$request->get('quantity');

        if ($quantityToSell <= 0) {
            return redirect()->back()->withErrors(['quantity' => 'Invalid quantity. Please enter a positive value.'])->withInput();
        }

        if ($request->get('selling_price') < $product->sold_price) {
            return redirect()->back()->withErrors(['selling_price' => 'Selling price must be greater than product selling price.'])->withInput();
        }

        if ($product->quantity <= 0) {
            $product->status = ProductStatusEnum::OUT_OF_STOCK;
            $product->save();
        }

        if ($quantityToSell > $product->quantity) {
            return redirect()->back()->with('error', 'Not enough stock available to complete this sale.');
        }


        $product->quantity -= $quantityToSell;
        $product->save();

        $soldProduct = new SoldProduct();
        $soldProduct->admin_id = Auth::id();
        $soldProduct->product_id = $product->id;
        $soldProduct->quantity_sold = $quantityToSell;
        $soldProduct->selling_price = $request->get('selling_price');
        $soldProduct->save();

        return redirect()->back()->with('success', 'Product Sold Successfully');
    }
}
