<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['admin'])->group(function () {
    Route::get('{locale}/dashboard', 'ShowDashboard')->name('dashboard');
    Route::resource('{locale}/posts', 'PostController');
    Route::resource('{locale}/tags', 'TagController');
    Route::resource('{locale}/categories', 'CategoryController');
    Route::resource('{locale}/settings', 'SettingController')->only(['index', 'update']);
    Route::delete('{locale}/posts/{post}/thumbnail', 'PostThumbnailController@destroy')->name('posts_thumbnail.destroy');
    Route::resource('{locale}/users', 'UserController')->only(['index', 'edit', 'update']);
    Route::resource('{locale}/comments', 'CommentController')->only(['index', 'edit', 'update', 'destroy']);
    Route::resource('{locale}/media', 'MediaLibraryController')->only(['index', 'show', 'create', 'store', 'destroy']);
});
