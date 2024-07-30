<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
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

class ProductController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'thumb_image' => ['required','image','max:3000'],
            'name' => ['required','max:200'],
            'category' => ['required'],
            'brand' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required','max:600'],
            'long_description' => ['required'],
            'product_type' => ['required'],
            'seo_title' => ['nullable','max:200'],
            'seo_description' => ['nullable','max:250'],
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
        $product->is_approved = 1;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->status = $request->status;
        $product->save();

        toastr()->success('Product Created Successfully!');

        return redirect()->route('admin.products.index'); 

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
        $childCategories = ChildCategory::where('sub_category_id', $product->sub_category_id)->get();
        $subCategories = SubCategory::where('category_id', $product->category_id)->get();
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.product.edit', compact('product', 'categories', 'brands', 'subCategories', 'childCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'thumb_image' => ['image','max:3000'],
            'name' => ['required','max:200'],
            'category' => ['required'],
            'brand' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required','max:600'],
            'long_description' => ['required'],
            'product_type' => ['required'],
            'seo_title' => ['nullable','max:200'],
            'seo_description' => ['nullable','max:250'],
            'status' => ['required']
        ]);

        $product = Product::findOrFail($id);

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
        $product->is_approved = 1;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->status = $request->status;
        $product->save();

        toastr()->success('Product Updated Successfully!');

        return redirect()->route('admin.products.index'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        /* $product = Product::findOrFail($id);
        $productImageGalleryCheck = ProductImageGallery::where('product_id', $product->id)->count();
        $productVariantCheck = ProductVariant::where('product_id', $product->id)->count();

        if($productImageGalleryCheck > 0 || $productVariantCheck > 0){
            return response(['status' => 'error',
            'message' => 'This product contains product image gallery or product variant in it, delete the product variant first to delete this product!'
            ]);
        }

        $this->deleteImage($product->thumb_image);
        $product->delete();

        return response(['status' => 'success',
                        'message' => 'Your file has been deleted.'
                        ]); */

        $product = Product::findOrFail($id);
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

    public function getSubCategories(Request $request)
    {
        $subCategories = SubCategory::where('category_id', $request->id)->where('status', 1)->get();
        return $subCategories;
    }

    public function getChildCategories(Request $request)
    {
        $childCategories = ChildCategory::where('sub_category_id', $request->id)->where('status', 1)->get();
        return $childCategories;
    }
}
