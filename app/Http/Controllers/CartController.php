<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Throwable;
use App\User;
use App\Cart;
use App\Product;
use DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $cart = DB::table('carts')
            ->join('users', 'carts.user_id', '=', 'users.id')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('users.id','products.*','carts.*')
            ->where('users.id', '=', $user->id)
            ->get();
        return response($cart);
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
        $user = Auth::user();
        try{
            $request = $request->validate([
                'product_id' => 'required|numeric',
                'quantity' => 'required|numeric|min:1'
            ]);
        }catch(Throwable $e){
            return response() -> json([
                "message" => "Please send valid fields.",
            ], 400);
        }

        if($product = Product::find($request['product_id'])){
            $cartProduct = new Cart();

            $cartProduct->user_id = $user->id;
            $cartProduct->product_id = $request['product_id'];
            $cartProduct->quantity = $request['quantity'];

            if($cartProduct->save()){
                return response() -> json([
                    "message" => "Products added correctly to cart.",
                    "product" => $product
                ], 200);
            }
        }else{
            return response() -> json([
                "message" => "Ups! This product does not exist."
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $user = Auth::user();
        try{
            $request = $request->validate([
                'quantity' => 'required|numeric',
            ]);
        }catch(Throwable $e){
            return response() -> json([
                "message" => "Please, send valid fields."
            ], 400);
        }
        if($cartProduct = Cart::where('user_id',$user->id)->where("id",$id)->get()[0]){
            $quantity = ($cartProduct->quantity);
            $newQuantity = $quantity + ($request['quantity']);
            $product = Product::find($cartProduct->product_id);
            if($product->stock < $newQuantity){
                return response() -> json([
                    "message" => "Ups! you have reached stock limit.\nProduct: ".$product->name
                ], 400);
            }else{
                if($newQuantity == 0){
                    if(Cart::find($cartProduct->id)->delete()){
                        return response() -> json([
                            "message" => "Product successfully deleted from cart."
                        ], 200);
                    }
                }
                $cartProduct->quantity = $newQuantity;
    
                if($cartProduct->save()){
                    return response() -> json([
                        "message" => "Cart successfully updated.",
                        "product" => $cartProduct,
                        "quantity" => $newQuantity
                    ], 200);
                }else{
                    return response() -> json([
                        "message" => "Ups! something went wrong."
                    ], 400);
                }
            }
        }else{
            return response() -> json([
                "message" => "It seems you don't have this product in your cart."
            ], 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if(Cart::find($id)->delete()){
            return response() -> json([
                "message" => "Product successfully deleted from cart."
            ], 200);
        }else{
            return response() -> json([
                "message" => "It seems you don't have this product in your cart."
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyAll(){
        $user = Auth::user();
        if(Cart::where('user_id',$user->$id)->delete()){
            return response() -> json([
                "message" => "All products successfully deleted from cart."
            ], 200);
        }else{
            return response() -> json([
                "message" => "It seems you don't have this product in your cart."
            ], 400);
        }
    }

    public function checkout(Request $request){
        $cart = $request->cart;
        $information = $request->information;
        if(count($cart)>0){
            //Delete quantity of items from stock
            DB::beginTransaction();
            foreach($cart as $item){
                $prod = DB::table('products')->where('id',$item['product_id'])->get()[0];
                $quantity = $item['quantity'];
                if($prod->stock >= $quantity){;
                    $newStock = $prod->stock - $quantity;
                    DB::table('products')->where('id', ($prod->id))->update(['stock' => $newStock]);
                }else{
                    DB::rollBack();
                    return response() -> json([
                        "message" => "It seems there aren't enough ".$item['name']."."
                    ], 400);
                }
            }
            foreach($cart as $item){
                if(!DB::table('carts')->where('id',$item['id'])->delete()){
                    DB::rollBack();
                    return response() -> json([
                        "message" => "Ups! Something went wrong"
                    ], 400);
                }
            }
            DB::commit();
            return response() -> json([
                "message" => "Payment successfully done!"
            ], 200);
        }else{
            return response() -> json([
                "message" => "You don't have any product in your cart"
            ], 400);
        }
    }
}
