<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderData = Order::find($id);
        $pageName = 'order_details';

        return view('admin/order/details', ['pageName' => $pageName, 'orderData' => $orderData, 'orderCount' => $this->orderCount]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function orderList($status)
    {
        $allOrders = Order::where('status', $status)->with('order_details', 'customer', 'order_details.product')->get();
        $pageName = $status . '_order';

        return view('admin/order/list', ['pageName' => $pageName, 'allOrders' => $allOrders, 'orderCount' => $this->orderCount]);
    }

    public function updateOrderStatus($id, $status)
    {
        $orderData = Order::find($id);
        $orderStatusToBe = $orderCurrentStatus = 0;
        if ($status == 'preparing') {
            $orderStatusToBe = 1;
        } else if ($status == 'sent_to_delivery') {
            $orderStatusToBe = 2;
        } else if ($status == 'completed') {
            $orderStatusToBe = 3;
        } else if ($status == 'cancelled') {
            $orderStatusToBe = 4;
        }
        if ($orderData->status == 'preparing') {
            $orderCurrentStatus = 1;
        } else if ($orderData->status == 'sent_to_delivery') {
            $orderCurrentStatus = 2;
        } else if ($orderData->status == 'completed') {
            $orderCurrentStatus = 3;
        } else if ($orderData->status == 'cancelled') {
            $orderCurrentStatus = 4;
        }

        if ($orderCurrentStatus >= $orderStatusToBe) {
            Session::flash('success_message', 'Order already updated.');
            Session::flash('alert-class', 'alert-danger');

            return response()->json(['success' => 'success'], 200);
        }

        $orderData->status = $status;
        $orderData->save();

        Session::flash('success_message', 'Order status updated successfully.');
        Session::flash('alert-class', 'alert-success');

        return response()->json(['success' => 'success'], 200);
    }
    public function checkNewOrder()
    {
        $newOrderCount = Order::where('status', 'new')->where('payment_status', 'paid')->count();

        return response()->json(['success' => 'success', 'newOrderCount' => $newOrderCount], 200);
    }
}
