<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['admin'])->group(function () {
    Route::get('{locale}/dashboard', 'ShowDashboard')->name('dashboard');

    Route::resource('{locale}/posts', 'PostController');

    Route::resource('{locale}/docs', 'DocsController');

    Route::resource('{locale}/tags', 'TagController');

    Route::resource('{locale}/categories', 'CategoryController');

    Route::resource('{locale}/settings', 'SettingController')->only(['index', 'update']);

    Route::delete('{locale}/posts/{post}/thumbnail', 'PostThumbnailController@destroy')
        ->name('posts_thumbnail.destroy');

    Route::delete('{locale}/docs/{doc}/thumbnail', 'DocsThumbnailController@destroy')
        ->name('docs_thumbnail.destroy');

    Route::resource('{locale}/users', 'UserController')->only(['index', 'edit', 'update']);

    Route::resource('{locale}/comments', 'CommentController')->only(['index', 'edit', 'update', 'destroy']);

    Route::get('{locale}/media/create_collection', 'MediaLibraryController@createCollection')
        ->name('media.create_collection');

    Route::get('{locale}/media/edit_collection/{collection}', 'MediaLibraryController@editCollection')
        ->name('media.edit_collection');

    Route::post('{locale}/media/update_collection/{collection}', 'MediaLibraryController@updateCollection')
        ->name('media.update_collection');

    Route::delete('{locale}/media/destroy_collection/{collection}', 'MediaLibraryController@destroyCollection')
        ->name('media.destroy_collection');


    Route::post('{locale}/media/store_collection', 'MediaLibraryController@storeCollection')
        ->name('media.store_collection');

    Route::get('{locale}/media/collections', 'MediaLibraryController@collections')
        ->name('media.collections');

    Route::resource('{locale}/media', 'MediaLibraryController')->only(['index', 'show', 'create', 'store',
        'destroy']);
});
