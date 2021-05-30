<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CatgeoryRequest;
use App\Models\Category;
use App\Services\Backend\CategoryServices;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parents = Category::where('parent_id', null)->get();
        $categories = Category::paginate(10);
        return view('backend.category.index', compact('parents', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CatgeoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CatgeoryRequest $request)
    {
        $fileName = null;

        if ($request->hasFile('image')) {
            $fileName = CategoryServices::storeImage($request->name, $request->file('image'));
        }

        try {
            Category::create([
                'parent_id' => $request->parent_id != 0 ? $request->parent_id : null,
                'name' => $request->name,
                'image' => $fileName,
                'status' => $request->filled('status'),
            ]);
            Toastr::success('Category Inserted', 'Success', ['options']);
        } catch (\Exception $e) {
            Toastr::success($e->getMessage(), 'Error', ['options']);
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $editcat = $category;
        $parents = Category::where('parent_id', null)->where('id', '!=', $category->id)->get();
        $categories = Category::paginate(10);
        return view('backend.category.index', compact('parents', 'categories', 'editcat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\CatgeoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CatgeoryRequest $request, Category $category)
    {
        $fileName = $category->image;

        if ($request->hasFile('image')) {
            $fileName = CategoryServices::updateImage($request->name, $request->file('image'), $category->image);
        }

        try {
            $category->update([
                'parent_id' => $request->parent_id != 0 ? $request->parent_id : null,
                'name' => $request->name,
                'image' => $fileName,
                'status' => $request->filled('status'),
            ]);
            Toastr::success('Category Updated', 'Success', ['options']);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error', ['options']);
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Category::where('parent_id', $category->id)->update(['parent_id' => null]);
        $disk = Storage::disk('public');
        try {
            if ($disk->exists('category/' . $category->image)) {
                $disk->delete('category/' . $category->image);
            }
            $category->delete();
            Toastr::success('Category Updated', 'Success', ['options']);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error', ['options']);
        }
        return redirect()->route('admin.category.index');
    }
}
