<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\subCategory;
use App\Supports\Helper;
use Illuminate\Http\Request;
use function Ramsey\Collection\Map\get;
use function Symfony\Component\Mime\Header\all;

class SupportController extends Controller
{
    use Helper;

    public function requireData()
    {
        $array = request()->all();
        $data = [];
        if (in_array('category', $array)) {
            $data['category'] = Category::get();
        }
        if (in_array('subCategory', $array)) {
            $data['subCategory'] = subCategory::get();
        }
        return $this->returnData(2000, $data);

    }
}
