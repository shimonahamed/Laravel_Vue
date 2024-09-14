<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    public function sub_menus(){
        return $this->hasMany(Module::class,'parent_id','id');
    }
}
