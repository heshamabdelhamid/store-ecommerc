<?php

namespace App\Http\Controllers\Dashboard\Categories;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreMainCategoryRequest;
use App\Http\Requests\Category\UpdateMainCategoryRequest;
use Illuminate\Http\Request;

class MainCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::parent()->paginate(PAGINATION_COUNT);

        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id', 'parent_id')->get();
        return view('dashboard.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMainCategoryRequest $request)
    {
        try {
            // dd($request);

            // DB::beginTransaction();
            if (!$request->is_active)
                $request->is_active = 0;

            Category::create($request->all());
            return redirect()->back()->with(['success' => 'تم التحديث بنجاح']);
            // DB::commit();

        } catch (\Exception $ex) {
            // DB::rollback();
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        if (!$category)
            return redirect()->back()->with(['error' => 'not found ']);

        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMainCategoryRequest $request)
    {
        try {
            $category = Category::find($request->id);

            if (!$request->is_active)
                $request->is_active = 0;

            $category->update($request->all());

            return redirect()->back()->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'هناك خطا ما يرجي المحاولة فيما بعد']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Category::FindOrFail($request->id)->delete();
        return redirect()->back()->with(['success' => 'تم الحذف بنجاح']);

        // try {

        //     if (!$category)
        //         return redirect()->back()->with(['error' => 'this category not found ']);

        //     $category->delete();

        // } catch (\Exception $ex) {
        //     return redirect()->back()->with(['error' => 'هناك خطا ما يرجي المحاولة فيما بعد']);
        // }
    }
}
