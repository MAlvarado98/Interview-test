<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Product;
use App\Cart;
use Throwable;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $category
     * @return \Illuminate\Http\Response
     */
    public function index($category)
    {
        $elements = Product::where('type', $category)->get();
        return response($elements);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $elements = Product::all();
        return response($elements);
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
        if($user->role == 2){
            try{
                $request = $request->validate([
                    'name' => 'required|string|max:150',
                    'image' => 'required|string',
                    'description' => 'required|string',
                    'price' => 'required|numeric|min:0',
                    'stock' => 'required|numeric|min:1',
                    'type' => 'required|string|max:30'
                ]);
            }catch(Throwable $e){
                return response()->json([
                    "message" => "Error. You should give valid fields."
                ],400);
            }
            $explodedImage = explode(',', $request['image']);
            $decoded = base64_decode($explodedImage[1]);
            $extension;
            if(str_contains($explodedImage[0], 'jpeg') || str_contains($explodedImage[0], 'jpg')){
                $extension = 'jpg';
            }else{
                return response()->json([
                    "message" => "You can only upload jpg or jpeg files."
                ], 400);
            }
    
            $hoy = date("m-d-y");   
            $fileName = explode(' ',$request['name'])[0]."-".
                        $request['type']."-".
                        Str::random(30)."-".
                        $hoy.".".
                        $extension;
            $productSlug = substr($fileName,0,-4);
            
            $path = public_path()."/img/products/".$fileName;
            file_put_contents($path, $decoded);
    
            $product = new Product();
            
            $product->name = $request['name'];
            $product->id_image = $fileName;
            $product->slug = $productSlug;
            $product->description = $request['description'];
            $product->price = $request['price'];
            $product->status = 1;
            $product->stock = $request['stock'];
            $product->type = $request['type'];
    
            if($product->save()){
                return response() -> json([
                    "message" => "Product created.",
                    "product" => $product
                ], 201);
            }else{
                return response() -> json([
                    "message" => "Error creating product."
                ], 400);
            }
        }else{
            return response()->json([
                "message" => "Sorry, you don't have permissions to do this."
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id $productSlug
     * @return \Illuminate\Http\Response
     */
    public function show($id, $productSlug)
    {
        if($element = Product::where('slug', $productSlug)->get()){
            return response($element[0]);
        }else{
            return response()->json([
                "message" => "Sorry, this product doesn't exist"
            ], 400);
        }
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
        if($user->role == 2){
            try{
                $request->validate([
                    'name' => 'required|string|max:150',
                    'description' => 'required|string',
                    'price' => 'required|numeric|min:0',
                    'stock' => 'required|numeric|min:1',
                    'type' => 'required|string|max:30',
                    'status' => 'numeric'
                ]);
            }catch(Throwable $e){
                return response()->json([
                    "message" => "Error. You should give valid fields."
                ],400);
            }
    
            $productSlug;
            $fileName;
            $currentProduct = Product::find($id);
            if($request['image']!=""){
                //Delete current image
                $existentImage = $currentProduct->id_image;
                unlink(public_path()."/img/products/".$existentImage);
    
                //Get Base 64 encoded image
                $explodedImage = explode(',', $request['image']);
                $decoded = base64_decode($explodedImage[1]);
                //Retrieve of extension and validaton - ONLY ACCEPT JPG -
                $extension;
                if(str_contains($explodedImage[0], 'jpeg') || str_contains($explodedImage[0], 'jpg')){
                    $extension = 'jpg';
                }else{
                    return response()->json([
                        "message" => "You can only upload jpg or jpeg files."
                    ], 400);
                }
    
                // Generate image name and product slug
                $hoy = date("m-d-y");   
                $fileName = explode(' ',$request['name'])[0]."-".
                            $request['type']."-".
                            Str::random(30)."-".
                            $hoy.".".
                            $extension;
                $productSlug = substr($fileName,0,-4);
                
                //Store image in public folder
                $path = public_path()."/img/products/".$fileName;
                file_put_contents($path, $decoded);
            }
            
            $currentProduct->name = $request['name'];
            if(isset($fileName))
                $currentProduct->id_image = $fileName;
            if(isset($productSlug))
                $currentProduct->slug = $productSlug;
            $currentProduct->description = $request['description'];
            $currentProduct->price = $request['price'];
            $currentProduct->status = $request['status'];
            $currentProduct->stock = $request['stock'];
            $currentProduct->type = $request['type'];
    
            if($currentProduct->save()){
                return response() -> json([
                    "message" => "Product updated.",
                    "result" => $currentProduct
                ], 201);
            }else{
                return response() -> json([
                    "message" => "Error updating product."
                ], 400);
            }
        }else{
            return response()->json([
                "message" => "Error, you can't do this."
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
        if($user->role == 2){
            if($product = Product::find($id)){
                $existentImage = $product->id_image;
                unlink(public_path()."/img/products/".$existentImage);
                Cart::where('product_id',$id)->delete();
                $product->delete();
                return response()->json([
                    "message" => "Product deleted successfully."
                ], 200);
            }else{
                return response()->json([
                    "message" => "Error, this product doesn't exist."
                ], 400);
            }
        }else{
            return response()->json([
                "message" => "Error, you can't do this."
            ], 400);
        }
    }
}
