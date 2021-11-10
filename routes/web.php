<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/locale/{locale}', 'PostController@switchLocale')->name('locale');

Route::get('/', 'PostController@setLocale')->name('posts.set_locale');

Route::get('sitemap.xml', 'SitemapController@index')->name('sitemap.xml');

Route::get('{locale}/search', 'PostController@search')->name('posts.search');

Route::get('{locale}/tag/{slug}', 'TagController@show')->name('tags.show');

Route::get('{locale}/document/{document}', 'DocumentController@index')->name('document');

Route::get('/{locale}', 'PostController@index')->name('home');

Route::get('feed', 'PostFeedController@index')->name('posts.feed');

Route::get('{locale}/users/{user}', 'UserController@show')->name('users.show');

Route::get('{locale}/{slug}', 'PostController@show')->name('posts.show');

Route::get('{locale}/{slug_path}', 'CategoryController@show')
    ->where('slug_path','^[a-zA-Z0-9-_\/]+$')->name('categories.show');

Route::get('newsletter-subscriptions/unsubscribe', 'NewsletterSubscriptionController@unsubscribe')
    ->name('newsletter-subscriptions.unsubscribe');
