<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $datatable)
    {
        return $datatable->render('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'icon' => ['required', 'not_in:empty'],
            'name' => ['required', 'max:200', 'unique:categories,name'],
            'status' => ['required']
        ]);

        $category = new Category();

        $category->icon = $request->icon;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;
        $category->save();

        toastr('Created Successfully!', 'success');

        return redirect()->route('admin.category.index');
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
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'icon' => ['required', 'not_in:empty'],
            'name' => ['required', 'max:200', 'unique:categories,name,'.$id],
            'status' => ['required']
        ]);

        $category = Category::findOrFail($id);

        $category->icon = $request->icon;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;
        $category->save();

        toastr('Category Updated Successfully!', 'success');

        return redirect()->route('admin.category.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $subCategory = SubCategory::where('category_id', $category->id)->count();
        
        if($subCategory > 0){
            return response(['status' => 'error',
                        'message' => 'Category contains sub category, please delete sub category first.'
                        ]);
        }

        $category->delete();
        
        return response(['status' => 'success',
                        'message' => 'Category has been deleted.'
                        ]);
    }

    public function changeStatus(Request $request)
    {
        // dd($request->all());
        $category = Category::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();
         
        return response([
            'message' => 'Status has been change.'
        ]);
    }
}
