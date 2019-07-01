<?php

    namespace App\Http\Controllers;

    use App\Order;
    use Auth;
    use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


    class OrderController extends Controller
    {
        public function index()
        {
            return response()->json(Order::with(['product'])->get(),200);
        }

        public function deliverOrder(Order $order)
        {
            $order->is_delivered = true;
            $status = $order->save();

            return response()->json([
                'status'    => $status,
                'data'      => $order,
                'message'   => $status ? 'Order Delivered!' : 'Error Delivering Order'
            ]);
        }

        public function store(Request $request)
        {
            $order = Order::create([
                'ref' => $request->ref,
                'user_id' => Auth::id(),
                
                'address_id' => $request->address_id,
                
            ]);

            return response()->json([
                'status' => (bool) $order,
                'data'   => $order,
                'message' => $order ? 'Order Created!' : 'Error Creating Order'
            ]);
        }

        public function show(Order $order)
        {
            return response()->json($order,200);
        }

        public function update(Request $request, Order $order)
        {
            $status = $order->update(
                $request->only(['quantity'])
            );

            return response()->json([
                'status' => $status,
                'message' => $status ? 'Order Updated!' : 'Error Updating Order'
            ]);
        }

        public function uploadFile(Request $request)
        {
            
            if(!$request->input('image')){
                return response()->json('image error', 401);
            }
            
            $image = $request->input('image');
            $image= str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = str_random(10).'.'.'png';
            \File::put(public_path(). '/images/' . $imageName, base64_decode($image));

            return response()->json(asset("images/".$imageName),201);
        }

        public function destroy(Order $order)
        {
            $status = $order->delete();

            return response()->json([
                'status' => $status,
                'message' => $status ? 'Order Deleted!' : 'Error Deleting Order'
            ]);
        }
    }