<?php

namespace App\Http\Controllers;

use App\Models\subCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $data=subCategory::get();
        return response()->json(['result'=>$data,'status'=>2000],200);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

    }


    public function show(subCategory $subCategory)
    {

    }


    public function edit(subCategory $subCategory)
    {
        //
    }


    public function update(Request $request)
    {
        try {
            $id = $request->input('id');

            $category =subCategory::where('id', $id)->first();

            if ($category) {
                $category->name = $request->input('name');
                $category->category_id = $request->input('category_id');
                $category->update();

                return response()->json(['status' => 2000]);
            }

            return response()->json(['status' => 3000]);
        } catch (\Exception $e) {
            return response()->json(['result' => null, 'message' => $e->getMessage(), 'status' => 5000]);
        }
    }


    public function destroy(subCategory $subCategory)
    {
        //
    }
}
