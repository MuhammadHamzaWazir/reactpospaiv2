<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Resources\BlogResource;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = Blog::all();
        return response([ 'Blogs' => 
        BlogResource::collection($blog), 
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
            'status' => 'required|max:1'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 
            'Validation Error']);
        }
        
        $blog = Blog::create($request->all());
        return response([ 'Blog' => new BlogResource($blog), 'message' => 'Success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return response([ 'Blog' => new 
        BlogResource($blog), 'message' => 'Success'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
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
            'status' => 'required|max:1'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 
            'Validation Error']);
        }
        $blog->update($request->all());
        return response([ 
            'Blog' => new BlogResource($blog), 
            'message' => 'Success'],
            200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return response(['message' => 'Blog deleted']);
    }
}
