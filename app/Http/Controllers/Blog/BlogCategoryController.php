<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Resources\BlogCategoryResource;
use Illuminate\Support\Facades\Validator;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogCategory = BlogCategory::all();
        return response([ 'BlogCategories' => 
        BlogCategoryResource::collection($blogCategory), 
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
        
        $blogCategory = BlogCategory::create($request->all());
        return response([ 'BlogCategory' => new BlogCategoryResource($blogCategory), 'message' => 'Success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BlogCategory $blogCategory)
    {
        return response([ 'BlogCategory' => new 
        BlogCategoryResource($blogCategory), 'message' => 'Success'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogCategory $blogCategory)
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
        $blogCategory->update($request->all());
        return response([ 
            'BlogCategory' => new BlogCategoryResource($blogCategory), 
            'message' => 'Success'],
            200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogCategory $blogCategory)
    {
        $category->delete();
        return response(['message' => 'Blog Category deleted']);
    }
}
