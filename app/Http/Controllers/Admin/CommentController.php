<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CommentsRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CommentController extends Controller
{
    /**
     * Show the application comments index.
     */
    public function index(): View
    {
        return view('admin.comments.index', [
            'comments' => Comment::with('post', 'author')->latest()->paginate(50)
        ]);
    }

    /**
     * Display the specified resource edit form.
     */
    public function edit($locale, Comment $comment): View
    {
        return view('admin.comments.edit', [
            'comment' => $comment,
            'users' => User::pluck('name', 'id')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($locale, CommentsRequest $request, Comment $comment): RedirectResponse
    {
        $comment->update($request->validated());

        return redirect()->to(routeLink('admin.comments.edit', $comment))->withSuccess(__('comments.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($locale, Comment $comment): RedirectResponse
    {
        $comment->delete();

        return redirect()->to(routeLink('admin.comments.index'))->withSuccess(__('comments.deleted'));
    }
}
