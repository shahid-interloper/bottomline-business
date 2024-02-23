<?php

namespace App\Http\Controllers\Api;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\OrderItem;
use App\Models\User;
use stdClass;

class OrderController extends Controller
{
    //
    public function placeOrder(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "shipping.first_name" => "required|string|min:3|max:15|regex:/^\S*$/u",
            "shipping.last_name" => "nullable|string|min:3|max:15|regex:/^\S*$/u",
            "shipping.address" => "required",
            "shipping.city" => "required",
            "shipping.zipcode" => "required",
            'payment_method' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)],403);
        }

        if ($request->payment_method == "credit card") {
            $request->validate([
                "payment.name" => "required|string",
                "payment.credit_card" => "required",
                "payment.cvv" => "required",
                "payment.exp_month" => "required",
                "payment.exp_year" => "required"
            ]);
        }

        $order = new Order();

        $orderNumber = 'TBZ' . date('ymdhis', time()) . Str::random(5);

        if ($request->user()) {
            $order->user_id = $request->user()->id;
            $order->is_guest = 0;
        } else {
            $order->is_guest = 1;
        }

        $customer = new stdClass;
        $customer->salutation = '';
        $customer->first_name = $request->user()->first_name;
        $customer->last_name = $request->user()->last_name;
        $customer->email = $request->user()->email;

        $order->order_number = $orderNumber;
        $order->sub_total = $request->sub_total;
        $order->shipping_charges = 0;
        $order->tax = 0;
        $order->total = $request->total;
        $order->delivery_details = json_encode($request->shipping);
        $order->payment_method = $request->payment_method;
        // $order->payment_details = json_encode($request->payment);
        $order->customer_details = json_encode($customer);
        $order->status_id = 1; //1 is considered as new order
        $user = User::find($request->user()->id);
        $user->address = $request->shipping['address'];
        $user->save();
        if ($order->save()) {
            foreach ($request->products as $item) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                if ($item['ptype'] == "variation") {
                    $orderItem->variation_id = $item['variation_id'];
                    $orderItem->is_variation = 1;
                } else {
                    $orderItem->product_id = $item['id'];
                    $orderItem->is_variation = 0;
                }
                $orderItem->image = $item['image'];
                $orderItem->name = $item['name'];
                $orderItem->price = $item['price'];
                $orderItem->quantity = $item['quantity'];
                $orderItem->total_amount = ($item['price'] * $item['quantity']);
                $orderItem->save();
            }
            
            return response()->json(['status' => 1,'message' => "Order Placed Successfully!"], 200);
        } else {
            $errors = [];
            // translate('messages.Unauthorized')
            array_push($errors, ['code' => 'order-001', 'message' => 'Failed to place order, please try again.']);
            return response()->json([
                'errors' => $errors
            ], 401);
        }
    }

    public function getOrder(Request $request,$status = 'process'){
        if($status == 'process')
            $statusArray = [1,2,4];
            // $statusArray = ['new','approve','processing'];
        elseif($status == 'completed')
            $statusArray = [3,5];
            // $statusArray = ['completed','deliver'];
        elseif($status == 'cancelled')
            $statusArray = [6,7];
            // $statusArray = ['cancel','Refund'];

        $orders = Order::with('orderItems:id,order_id,product_id,image,sku,name,price,quantity,total_amount')->whereIn('status_id',$statusArray)->where('user_id',$request->user()->id)->get();
        $orders->makeHidden(['payment_details','deleted_at','updated_at','metadata','is_guest']);
        return response()->json($orders, 200);
    }
}
