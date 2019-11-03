<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MCategory;

class CategoryController extends Controller
{
    public function add(Request $request)
    {
        $name = $request->input('name');

        MCategory::insert([
           'cat_name' => $name,
           'cat_active' => 1,
           'cat_delete' => 0 
        ]);

        $response['message'] = "$name save successfully";
        $response['success'] = true;
        return $response;
    }

    public function list()
    {
        $data = MCategory::where('cat_delete',0)->get();
        return $data;
    }

    public function available()
    {
        $data = MCategory::where('cat_delete',0)->where('cat_active',1)->get();
        return $data;
    }

    public function change_status(Request $request)
    {
        $idcat = $request->input("idcat");
        $status = $request->input('status');

        MCategory::where('cat_id',$idcat)->update([
            'cat_active' => $status
        ]);

        $response['message'] = "Update Successfully";
        $response['success'] = true;
        return $response;
    }
}
