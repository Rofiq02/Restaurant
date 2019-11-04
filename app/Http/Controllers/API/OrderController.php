<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MOrder;
use App\MRequests;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function create_order(Request $request)
    {
        $today = Carbon::now()->format('Y-m-d h:i:s');
        //get array order
        $ordered = $request->input('requests');

        $orderdata['ord_status'] = 1;
        $orderdata['ord_mesa'] = $request->input('mesa');
        $orderdata['ord_value'] = $request->input('total');
        $orderdata['ord_date'] = $today;

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

    public function list_order()
    {
        $today_date = Carbon::now()->format('Y-m-d');

        //get order per today
        $order = MOrder::whereDate('ord_date',$today_date)->get();

        foreach ($order as $value){
            $value['show'] = false;
            //add day details order
            $value['requests'] = MRequests::join('products','products.prod_id', '=', 'requests.req_product')
                                            ->where('req_order',$value->ord_id)->get();
        }

        return $order;
    }
}
