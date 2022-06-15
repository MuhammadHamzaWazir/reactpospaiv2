<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return response([ 'Products' => 
        ProductResource::collection($product), 
        'message' => 'Successful'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'user_id' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_tag' => 'required',
            'title' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'original_price' => 'required',
            'discount_price' => 'required',
            'in_stock' => 'required',
            'status' => 'required|max:1'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 
            'Validation Error']);
        }
        
        $product = Product::create($request->all());
        return response([ 'Product' => new ProductResource($product), 'message' => 'Success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response([ 'Product' => new 
        ProductResource($product), 'message' => 'Success'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'user_id' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_tag' => 'required',
            'title' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'original_price' => 'required',
            'discount_price' => 'required',
            'in_stock' => 'required',
            'status' => 'required|max:1'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 
            'Validation Error']);
        }
        $product->update($request->all());
        return response([ 
            'Product' => new ProductResource($product), 
            'message' => 'Success'],
            200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response(['message' => 'Product deleted']);
    }
}
