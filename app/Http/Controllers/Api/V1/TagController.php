<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TagsRequest;
use App\Http\Resources\Tag;
use App\Models\Post;
use App\Models\Tag as TagModel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;


class TagController extends Controller
{
    /**
     * Return tags.
     */
    public function index($locale, Request $request): ResourceCollection
    {
        $q = $request->get('q');
        $tags = collect();
        if ($q) {
            $q = explode(',', $q);
            foreach ($q as $tag) {
                if ($tag) {
                    $tags[] = TagModel::usingLocale($locale)->containing($tag, $locale)->first();
                }
            }
        }
        return Tag::collection(
            $tags->filter()
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($locale, \Illuminate\Support\Facades\Request $request): Tag
    {
//        $this->authorize('update', new TagModel());

//        $post->update($request->only(['title', 'content', 'posted_at', 'author_id', 'thumbnail_id']));

        return new Tag($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($locale, TagsRequest $request)
    {
        $data = $request->all();
        $o = app($data['taggable_type'])->find($data['taggable_id']);

        $tag = TagModel::usingLocale($data['locale'])::findOrCreateFromString($data['name'], Post::class, $data['locale']);

        if ($o) {
            $o->attachTag($tag);
        }

        return $data;
    }

    /**
     * Return the specified resource.
     */
    public function show(Post $post): Tag
    {
        return new Tag($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($locale, $tag, Request $request): Response
    {
        $data = $request->all();

        $tag = TagModel::usingLocale($data['locale'])->containing(urldecode($tag), $data['locale'])->first();

        if ($tag) {
            $tag->delete();
        }

        return response()->noContent();
    }
}
