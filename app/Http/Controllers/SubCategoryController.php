<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\subCategory;
use App\Supports\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller

{
    use Helper;

    public function __construct()
    {
        $this->model = new subCategory();
    }

    public function index()
    {
        $data = $this->model->get();
        return $this->returnData(2000, $data);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validator = $this->model->Validator($request->all());
        if ($validator->fails()) {
            return response()->json(['result' => $validator->errors(), 'status' => 3000], 200);
        }
        $this->model->fill($request->all());
        $this->model->save();
        return $this->returnData(2000, $this->model);
    }


    public function show(Category $category)
    {

    }

    public function edit(Category $category)
    {

    }

    public function update(Request $request)
    {

        try {
            $validator = $this->model->Validator($request->all());
            if ($validator->fails()) {
                return response()->json(['result' => $validator->errors(), 'status' => 3000], 200);
            }


            $category = $this->model->where('id', $request->input('id'))->first();

            if ($category) {
                $category->fill($request->all());
                $category->save();
                return $this->returnData(2000, $category);

            }

            return $this->returnData(3000, null, 'Category not found');
        } catch (\Exception $e) {
            return response()->json(['result' => null, 'message' => $e->getMessage(), 'status' => 5000]);
        }
    }


    public function destroy($category_id)
    {
        try {
            $data = $this->model->where('id',$category_id)->first();
            if ($data){
                $data->delete();

                return $this->returnData(2000, null, 'Category deleted successfully');
            }
            return $this->returnData(3000, null, 'Category not found');

        }catch (\Exception $exception){
            return $this->returnData(5000, $exception->getMessage(), 'Something Wrong');
        }
    }
}