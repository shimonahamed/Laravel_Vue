<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public $model='';
    public function  __construct()
    {
        $this->model=new Category();
    }

    public function index()
    {
        $data=$this->model->get();
        return response()->json(['result'=>$data,'status'=>2000],200);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validator=$this->model->validator($request->all());
        dd($request->all());

        if ($validator->fills()){
            return response()->json(['result' => $validator->errors(), 'status' => 3000], 200);
        }
        $this->model->fill($request->all());
        $this->model->save();
        return response()->json(['result' =>  $this->model, 'status' => 2000], 200);
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

            $category =Category::where('id', $id)->first();

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
            $category = Category::where('id', $id)->first();

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
