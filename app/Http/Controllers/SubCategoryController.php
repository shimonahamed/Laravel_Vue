<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\subCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    public $model='';
    public function  __construct()
    {
        $this->model=new Category();
    }

    public function index()
    {
        $data=subCategory::get();
        return response()->json(['result'=>$data,'status'=>2000],200);
    }


    public function create()
    {

    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => $validator->errors(), 'status' => 3000], 200);
        }

        $subCat = new subCategory();
        $subCat->fill($request->all());
        $subCat->save();

        return response()->json(['result' => $subCat, 'status' => 2000], 200);
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


    public function destroy($id)
    {
        try {
            $category = subCategory::where('id', $id)->first();

            if ($category) {

                $category->delete();
                return response()->json(['status' => 2000]);
            }

            return response()->json(['status' => 3000]);
        } catch (\Exception $e) {
            return response()->json(['result' => null, 'message' => $e->getMessage(), 'status' => 5000]);
        }
    }
}
