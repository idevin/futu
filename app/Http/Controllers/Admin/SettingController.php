<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingsRequest;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class SettingController extends Controller
{
    /**
     * Show the application users index.
     */
    public function index(): View
    {
        return view('admin.settings.index', [
            'settings' => Setting::query()->first()
        ]);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function update($locale, SettingsRequest $request, Setting $setting): RedirectResponse
    {
        $data = $request->all();

        $showAuthor = $data['show_author'] ?? 0;
        $showDate = $data['show_date'] ?? 0;
        $allowComments = $data['allow_comments'] ?? 0;
        $showCommentsCount = $data['show_comments_count'] ?? 0;
        $showLikesCount = $data['show_likes_count'] ?? 0;

        $setting->update([
            'show_author' => $showAuthor,
            'show_date' => $showDate,
            'allow_comments' => $allowComments,
            'show_comments_count' => $showCommentsCount,
            'show_likes_count' => $showLikesCount,
            'content' => $data['content'],
            'title' => $data['title'],
            'meta_title' => $data['meta_title'],
            'meta_keywords' => $data['meta_keywords'],
            'meta_description' => $data['meta_description'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'email' => $data['email'],
            'google_tag' => $data['google_tag'],
            'google_analytics' => $data['google_analytics'],
            'google_map' => $data['google_map']
        ]);

        return redirect()->to(routeLink('admin.settings.index'))->withSuccess(__('settings.updated'));
    }
}
