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

    public function list()
    {
        $list = MProduct::where('prod_delete',0)
                            ->join('category','category.cat_id', '=', 'products.prod_category')
                            ->get();

        return $list;
    }

    public function change_status(Request $request)
    {
        $idprod = $request->input('idprod');
        $status = $request->input('status');

        Log::info('Updating status $idprod => $status');

        MProduct::where('prod_id', $idprod)->update([
            'prod_visible' => $status
        ]);

        $response['message'] = "Update Successfully";
        $response['success'] = true;

        return $response;
    }

    public function visible()
    {
        $data = MProduct::where('prod_delete', 0)
                            ->where('prod_visible', 1)
                            ->join('category', 'category.cat_id', '=', 'products.prod_category')
                            ->where('cat_active', 1)
                            ->get();

                foreach($data as $value){
                    $value['prod_image'] = asset('storage/'.$value->prod_image);
                }

        return $data;
    }
}
