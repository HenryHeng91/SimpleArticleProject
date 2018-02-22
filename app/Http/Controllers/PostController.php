<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Http\Resources\PostsResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return PostsResource
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate();
        return new PostsResource($posts);
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
        $this->doValidation($request);

        $file = $request->file('file');
        $filename = "";
        if ($file){
            $destinationPath = public_path('img/posts/');
            $filename = uniqid().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $filename);
        }

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->cover_img = asset("img/posts/$filename");
        $post->user_id = 1;
        $post->save();

        return response($post, 200);

//        return $request->user()->videos()->create(
//            $request->only((new \App\Models\Post)->getFillable())
//        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return PostResource
     */
    public function show($id)
    {
        return new PostResource(Post::with('user')->findOrFail($id));
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
     * @return PostResource
     */
    public function update(Request $request, $post)
    {
        $this->doValidation($request);

        if (! $post->update($request->only($post->fillable)) ) {
            return PostResource::error(400, 'Unable to update', 'Unable to update the resource');
        }

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Facades\Response
     */
    public function destroy(Request $request, $id)
    {
        $post = $request->user()->post()->find($id);
        if (!$post) {
            return PostResource::error(400, "Post not found!", "Post with ID $id not found or not own by user!");
        }

        return $post->delete()
            ? PostResource::error(204, '', '')
            : PostResource::error(500, 'Unable to delete', "Unable to delete postId $id");

    }

    /**
     * Validate the input from request
     * using the validation rule of the model
     *
     * */
    public function doValidation($request)
    {
        // run the validation
        $this->validate( $request, (new \App\Models\Post)->getValidationRules());
    }
}
