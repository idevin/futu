<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostLikeController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($locale, Post $post)
    {
        return $post->like();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $locale
     * @param Post $post
     * @return Response
     */
    public function destroy($locale, Post $post)
    {
        return $post->dislike();
    }
}
