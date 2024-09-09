<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class subCategory extends Model
{
    use HasFactory;
    protected $fillable=['name','category_id'];

    public function validator($input){
        return Validator::make($input,[
            'name'=>'required ',
            'category_id'=>'required '
        ]);
    }
}
