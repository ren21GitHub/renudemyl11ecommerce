<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request ,VendorProductVariantDataTable $dataTable)
    {
        $product = Product::findOrFail($request->product);

        /* Check if its owner's product */
        if($product->vendor_id !== Auth::user()->vendor->id){
            abort(404);
        }

        return $dataTable->render('vendor.product.variant.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('vendor.product.variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'max:200'],
            'product' => ['required', 'integer'],
            'status' => ['required']
        ]);

        $productVariant = new ProductVariant();

        $productVariant->name = $request->name;
        $productVariant->product_id = $request->product;
        $productVariant->status = $request->status;
        $productVariant->save();

        toastr('Product Variant Created Successfully!', 'success');

        // return view('vendor.product.variant.index');
        return redirect()->route('vendor.products-variant.index', ['product' => $request->product]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $productVariant = ProductVariant::findOrFail($id);

        /* Check if its owner's product variant */
        if($productVariant->product->vendor_id !== Auth::user()->vendor->id){
            abort(404);
        }

        return view('vendor.product.variant.edit', compact('productVariant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'status' => ['required']
        ]);

        $productVariant = ProductVariant::findOrFail($id);

        /* Check if its owner's product variant */
        if($productVariant->product->vendor_id !== Auth::user()->vendor->id){
            abort(404);
        }

        $productVariant->name = $request->name;
        $productVariant->status = $request->status;
        $productVariant->save();

        toastr('Product Variant Updated Successfully!', 'success');

        // return view('vendor.product.variant.index');
        return redirect()->route('vendor.products-variant.index', ['product' => $productVariant->product_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productVariant = ProductVariant::findOrFail($id);

        /* Check if its owner's product variant */
        if($productVariant->product->vendor_id !== Auth::user()->vendor->id){
            abort(404);
        }

        $productVariantItemCheck = ProductVariantItem::where('product_variant_id', $productVariant->id)->count();

        if($productVariantItemCheck > 0){
            return response(['status' => 'error',
                        'message' => 'This variant contains variant items in it, delete the variant items first to delete this variant!'
                        ]);
        }
        $productVariant->delete();

        return response(['status' => 'success',
                        'message' => 'Your file has been deleted.'
                        ]);
    }

    public function changeStatus(Request $request)
    {
        $productVariant = ProductVariant::findOrFail($request->id);
        $productVariant->status = $request->status == 'true' ? 1 : 0;
        $productVariant->save();
         
        return response([
            'message' => 'Status has been change.'
        ]);
    }
}
