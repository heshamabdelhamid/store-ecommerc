<?php

namespace App\Http\Controllers\Dashboard\Categories;

use App\Models\MainCategory;
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
        $categories = MainCategory::orderBy('id', 'DESC')->get();
        return view('dashboard.main_categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.main_categories.create');
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

            // check photo exists
            $request_data = $request->except(['photo']);

            if ($request->photo) {
                $file_name = $this->saveImage($request->photo, 'images/main-category');
                $request_data['photo'] = $file_name;
            }

            if (!$request->is_active)
                $request->request->add(['is_active' => 0]);

            dd($request_data);
            MainCategory::create($request_data);
            return redirect()->back()->with(['success' => 'تم التحديث بنجاح']);
            // DB::commit();
        } catch (\Exception $ex) {
            // DB::rollback();
            return redirect()->route('admin.main-category.store')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
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
        $category = MainCategory::find($id);

        if (!$category)
            return redirect()->back()->with(['error' => 'not found ']);

        return view('dashboard.main_categories.edit', compact('category'));
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
            $category = MainCategory::find($request->id);

            if (!$request->is_active)
                $request->request->add(['is_active' => 0]);

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
        try {
            MainCategory::FindOrFail($request->id)->delete();
            return redirect()->back()->with(['success' => 'تم الحذف بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'هناك خطا ما يرجي المحاولة فيما بعد']);
        }
    }
}
