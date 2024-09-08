<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Category extends Model
{
    use HasFactory;

    protected $fillable=['name'];

    public function validator($input){
        return Validator::make($input,[
            'name'=>'required | email'
            ]);
    }
}
