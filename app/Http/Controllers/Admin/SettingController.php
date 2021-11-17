<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingsRequest;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

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
            'show_likes_count' => $showLikesCount
        ]);

        return redirect()->to(routeLink('admin.settings.index'))->withSuccess(__('settings.updated'));
    }
}
