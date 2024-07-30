<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class ProductVariantItemController extends Controller
{
    public function index(ProductVariantItemDataTable $dataTable, $productId, $variantId)
    {
        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId);
        return $dataTable->render('admin.product.variant-item.index', compact('product', 'variant'));
    }

    public function create(string $productId, string $variantId)
    {
        // dd($id);
        $product = ProductVariant::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId);

        return view('admin.product.variant-item.create', compact('product','variant'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'variant_id' => ['required','integer'],
            'name' => ['required', 'max:200'],
            'price' => ['required', 'integer'],
            'is_default' => ['required'],
            'status' => ['required']
        ]);

        $productVariantItem = new ProductVariantItem();

        $productVariantItem->product_variant_id = $request->variant_id;
        $productVariantItem->name = $request->name;
        $productVariantItem->price = $request->price;
        $productVariantItem->is_default = $request->is_default;
        $productVariantItem->status = $request->status;
        $productVariantItem->save();

        toastr('Product Variant Item Successfully Created!', 'success');

        return redirect()->route('admin.products-variant-item.index', ['productId' => $request->product_id, 'variantId' => $request->variant_id ]);
    }

    public function edit(string $id)
    {
        $productVariantItem = ProductVariantItem::findOrFail($id);
        return view('admin.product.variant-item.edit', compact('productVariantItem'));
    }

    public function update(Request $request, string $id)
    {
        // dd(request()->all());
        $request->validate([
            'name' => ['required', 'max:200'],
            'price' => ['required', 'integer'],
            'is_default' => ['required'],
            'status' => ['required']
        ]);

        $productVariantItem = ProductVariantItem::findOrFail($id);

        $productVariantItem->name = $request->name;
        $productVariantItem->price = $request->price;
        $productVariantItem->is_default = $request->is_default;
        $productVariantItem->status = $request->status;
        $productVariantItem->save();

        toastr('Product Variant Item Successfully Updated!', 'success');

        return redirect()->route('admin.products-variant-item.index', ['productId' => $productVariantItem->productVariant->product_id, 'variantId' => $productVariantItem->product_variant_id ]);

    }

    public function destroy(string $id)
    {
        $productVariantItem = ProductVariantItem::findOrFail($id);
        $productVariantItem->delete();

        return response([
            'status' => 'success',
            'message' => 'Deleted Successfully!'
        ]);
    }

    public function changeStatus(Request $request)
    {
        $productVariantItem = ProductVariantItem::findOrFail($request->id);
        $productVariantItem->status = $request->status == 'true' ? 1 : 0;
        $productVariantItem->save();
         
        return response([
            'message' => 'Status has been change.'
        ]);
    }
}
