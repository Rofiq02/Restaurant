<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MOrder;
use App\MRequests;

class OrderController extends Controller
{
    public function create_order(Request $request)
    {
        //get array order
        $ordered = $request->input('requests');

        $orderdata['ord_status'] = 1;
        $orderdata['ord_mesa'] = $request->input('mesa');
        $orderdata['ord_value'] = $request->input('total');

        //save the order
        $order = MOrder::create($orderdata);

        foreach(json_decode($ordered) as $item){
            $itemReq['req_product'] = $item->id;
            $itemReq['req_order'] = $order->id;
            $itemReq['req_qty'] = $item->cant;
            $itemReq['req_value'] = $item->price;

            MRequests::create($itemReq);
        }

        $response['success'] = true;
        $response['message'] = "Save successfully";
    }
}
