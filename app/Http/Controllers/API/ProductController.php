<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MProduct;
use Log;

class ProductController extends Controller
{
    public function create(Request $request)
    {
        $input['prod_name'] = $request->input('name');
        $input['prod_description'] = $request->input('description');
        $input['prod_category'] = $request->input('category');
        $input['prod_price'] = $request->input('price');

        $input['prod_visible'] = 1;
        $input['prod_delete'] = 0;
        $input['prod_image'] = null;

        if($request->file('prod_image') == null)
        {
            $input['prod_image'] = null;
        }
        else{
            $image = $request->file('prod_image');
            //store the capture the file name
            $input['prod_image'] = $image->store('product','public');
        }

        $data = MProduct::insert($input);

        $response['message'] = "Save Successfully";
        $response['success'] = true;
        return $response;
    }
}
