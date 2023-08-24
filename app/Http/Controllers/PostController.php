<?php

namespace App\Http\Controllers;

use App\Http\traits\apiResponseTrait;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class PostController extends Controller
{
    /**
     * Handle Response for Methods
     * Type : Trait
     */
    use apiResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return auth('sanctum')->user()->id;
        return $this->responseSucsses(PostResource::collection(Post::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = Post::create([
            'name' => $request->name,
            'content' => $request->content,
            'user_id' => auth('sanctum')->user()->id,
        ]);
        return $this->responseSucsses(new PostResource($post), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $this->responseSucsses(new PostResource($post));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $user_id = auth('sanctum')->user()->id;
        if ($post->user_id == $user_id) {
            $post->update([
                'name' => $request->name,
                'content' => $request->content,
                'user_id' => auth('sanctum')->user()->id,
            ]);
            if ($post) {
                return $this->responseSucsses(new PostResource($post), 202);
            }
            return $this->responseError('not updated', 400);
        }
        return $this->responseError('Unauthorized', 401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $user_id = auth('sanctum')->user()->id;
        if ($post->user_id == $user_id) {
            $post->delete();
            if (!$post) {
                return $this->responseSucsses('deleted');
            }
            return $this->responseError('bad request', 400);
        }
        return $this->responseError('Unauthorized', 401);
    }
}
