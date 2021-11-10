<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Comment as CommentResource;
use App\Http\Resources\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use JetBrains\PhpStorm\Pure;

class CommentController extends Controller
{
    /**
     * Return the comments.
     */
    public function index($locale, Request $request): ResourceCollection
    {
        return CommentResource::collection(
            Comment::latest()->paginate($request->input('limit', 5))
        );
    }

    /**
     * Return the specified resource.
     */
    #[Pure]
    public function show($locale, Comment $comment): CommentResource
    {
        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($locale, Comment $comment): Response
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return response()->noContent();
    }
}
