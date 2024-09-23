<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Models\ProductVariant;
use App\Models\SubCategory;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class VendorProductController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(VendorProductDataTable $dataTable)
    {

        return $dataTable->render('vendor.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('vendor.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'thumb_image' => ['required', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'brand' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required', 'max:600'],
            'long_description' => ['required'],
            'product_type' => ['required'],
            'seo_title' => ['nullable', 'max:200'],
            'seo_description' => ['nullable', 'max:250'],
            'status' => ['required']
        ]);

        $product = new Product();

        $imagePath = $this->uploadImage($request, 'thumb_image', 'uploads');
        $product->thumb_image = $imagePath;

        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->child_category_id = $request->child_category;
        $product->brand_id = $request->brand;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->qty = $request->qty;
        $product->video_link = $request->video_link;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->product_type = $request->product_type;
        $product->is_approved = 0;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->status = $request->status;
        $product->save();

        toastr()->success('Vendor Product Created Successfully!');

        return redirect()->route('vendor.products.index');
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
        $product = Product::findOrFail($id);
        /* Check if its owner's product */
        if($product->vendor_id !== Auth::user()->vendor->id){
            abort(404);
        }

        $childCategories = ChildCategory::where('sub_category_id', $product->sub_category_id)->get();
        $subCategories = SubCategory::where('category_id', $product->category_id)->get();
        $categories = Category::all();
        $brands = Brand::all();
        return view('vendor.product.edit', compact('product', 'childCategories', 'subCategories','categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'thumb_image' => ['image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'brand' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required', 'max:600'],
            'long_description' => ['required'],
            'product_type' => ['required'],
            'seo_title' => ['nullable', 'max:200'],
            'seo_description' => ['nullable', 'max:250'],
            'status' => ['required']
        ]);

        $product = Product::findOrFail($id);

        /* Check if its owner's product */
        if($product->vendor_id !== Auth::user()->vendor->id){
            abort(404);
        }

        $imagePath = $this->updateImage($request, 'thumb_image', 'uploads', $product->thumb_image);
        $product->thumb_image = empty(!$imagePath) ? $imagePath : $product->thumb_image;

        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->child_category_id = $request->child_category;
        $product->brand_id = $request->brand;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->qty = $request->qty;
        $product->video_link = $request->video_link;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->product_type = $request->product_type;
        // $product->is_approved = $request->is_approved;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->status = $request->status;
        $product->save();

        toastr()->success('Vendor Product Updated Successfully!');

        return redirect()->route('vendor.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        /* Check if its owner's product */
        if($product->vendor_id !== Auth::user()->vendor->id){
            abort(404);
        }

        /* Delete the main product image */
        $this->deleteImage($product->thumb_image);

        /* Delete product images gallery */
        $productImageGallery = ProductImageGallery::where('product_id', $product->id)->get();
        foreach($productImageGallery as $image){
            $this->deleteImage($image->image);
            $image->delete();
        }

        /* Delete product variants if exist */
        $productVariant = ProductVariant::where('product_id', $product->id)->get();
        foreach($productVariant as $variant){
            $variant->productVariantItems()->delete();
            $variant->delete();
        }

        $product->delete();

        return response(['status' => 'success',
                        'message' => 'Your file has been deleted.'
                        ]);
    }

    public function changeStatus(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->status = $request->status == 'true' ? 1 : 0;
        $product->save();

        return response([
            'message' => 'Status has been change.'
        ]);
    }

    /* Get all Product SubCategories */
    public function getSubCategories(Request $request)
    {
        $subCategories = SubCategory::where('category_id', $request->id)->get();

        return $subCategories;
    }
    /* Get all Product ChildCategories */
    public function getChildCategories(Request $request)
    {
        $childCategories = ChildCategory::where('sub_category_id', $request->id)->get();

        return $childCategories;
    }
}
