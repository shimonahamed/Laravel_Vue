<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Supports\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    use Helper;
    public function  __construct()
    {
        $this->model=new Category();
    }

    public function index()
    {
        $data=$this->model->get();
        return $this->returnData(2000,$data);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required ',
        ]);
        if ($validator->fails()){
            return response()->json(['result' => $validator->errors(), 'status' => 3000], 200);
        }
        $this->model->fill($request->all());
        $this->model->save();
        return $this->returnData(2000,$this->model);

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
            $id = $request->input('id');

            $category =$this->model->where('id', $id)->first();

            if ($category) {
                $category->name = $request->input('name');
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
            $category = $this->model->where('id', $id)->first();

            if ($category) {

                $category->delete();
                return $this->returnData(2000,null, 'Category deleted successfully');
            }

            return $this->returnData(3000, null,'Category deleted Unsuccessfully');

        } catch (\Exception $e) {
            return response()->json(['result' => null, 'message' => $e->getMessage(), 'status' => 5000]);
        }
    }
}
