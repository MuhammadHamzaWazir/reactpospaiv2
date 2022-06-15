<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return response([ 'Categories' => 
        CategoryResource::collection($category), 
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
        // dd($request->all());
         $validator = Validator::make($request->all(), [
            'name' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_tag' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'status' => 'required|max:1'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 
            'Validation Error']);
        }
        
        $category = Category::create($request->all());
        return response([ 'Category' => new CategoryResource($category), 'message' => 'Success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response([ 'Category' => new 
        CategoryResource($category), 'message' => 'Success'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_tag' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'status' => 'required|max:1'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 
            'Validation Error']);
        }
        $category->update($request->all());
        return response([ 
            'Category' => new CategoryResource($category), 
            'message' => 'Success'],
            200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response(['message' => 'Category deleted']);
    }
}
