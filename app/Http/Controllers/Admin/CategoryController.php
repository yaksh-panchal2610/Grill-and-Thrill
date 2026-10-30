<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allCategories = Category::all();

        $pageName = 'category_list';
        return view('admin/category/list', ['pageName' => $pageName, 'allCategories' => $allCategories, 'orderCount' => $this->orderCount]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageName = 'create_category';
        return view('admin/category/create', ['pageName' => $pageName, 'orderCount' => $this->orderCount]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);

        $input = $request->all();
        $input['image'] = time() . '.' . $request->image->extension();
        $categoryData = Category::create($input);

        $input['image'] = $categoryData->id . '.' . $request->image->extension();
        $request->image->move(public_path('images/category/'), $input['image']);

        $categoryData->image = $input['image'];
        $categoryData->save();

        Session::flash('success_message', 'Category created successfully.');
        Session::flash('alert-class', 'alert-success');

        return response()->json(['success' => 'success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryData = Category::find($id);

        $pageName = 'edit_category';
        return view('admin/category/edit', ['pageName' => $pageName, 'categoryData' => $categoryData, 'orderCount' => $this->orderCount]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $input = $request->all();
        $categoryData = Category::find($id);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($categoryData->image != "" && file_exists(public_path('images/category/') . $categoryData->image)) {
                unlink(public_path('images/category/') . $categoryData->image);
            }

            $input['image'] = $id . '.' . $request->image->extension();
            $request->image->move(public_path('images/category/'), $input['image']);
            $categoryData->image = $input['image'];
        }

        $categoryData->name = $input['name'];
        $categoryData->status = $input['status'];
        $categoryData->save();

        Session::flash('success_message', 'Category updated successfully.');
        Session::flash('alert-class', 'alert-success');

        return response()->json(['success' => 'success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
