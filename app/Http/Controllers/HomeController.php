<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\CartItems;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        return view('home');
    }

    public function services(Request $request){
        $services = DB::table('services')->get();
        $carts = DB::table('cart_items')
            ->join('pictures', 'cart_items.picture_id', "=", "pictures.id")
            ->get();
        return view('services', compact('services', 'carts'));
    }

    public function forums(Request $request){
        return view('forums');
    }

    public function blogs(Request $request){
        return view('blogs');
    }

    public function aboutus(Request $request){
        return view('aboutus');
    }




    public function getPictures(Request $request){
        $serviceId = $request->serviceId;

        $pictures = DB::table('pictures')
            ->where('service_id', $serviceId)
            // ->select('path')
            ->get();

        if ($request->isMethod('get')){    
            return response()->json($pictures); 
        }
    }

    public function addToCart(Request $request){
        $quantity = $request->quantity;
        $pictureId = $request->pictureId;
        
        $price = DB::table('pictures')->where('id', $pictureId)->value('price');
        $amount = $quantity*$price;

        $product_existed = DB::table('cart_items')->where('picture_id', $pictureId)->get();

        if ($product_existed == "[]" && $quantity != 0) {
            $carts = new CartItems;
            $carts->picture_id = $pictureId;
            $carts->quantity = $quantity;
            $carts->amount = $amount;
            $carts->save();
        }else{
            echo "string";
            $a = 0;
            while ($a < $quantity){
                DB::table('cart_items')->where('picture_id', $pictureId)->increment('quantity');
                $a++;
            }

            $quantity = DB::table('cart_items')->where('picture_id', $pictureId)->select('quantity');
            $amount = $quantity*$price;

            $carts = DB::table('cart_items')->find($pictureId);
            $carts->picture_id = $pictureId;
            $carts->quantity = $quantity;
            $carts->amount = $amount;
            $carts->save();

        }

        return redirect('/servicess');
    }
}
