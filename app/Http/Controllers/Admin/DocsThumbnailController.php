<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doc;
use Illuminate\Http\RedirectResponse;

class DocsThumbnailController extends Controller
{
    /**
     * Unset the post's thumbnail.
     */
    public function destroy($locale, Doc $doc): RedirectResponse
    {
        $doc->update(['thumbnail_id' => null]);

        return redirect()->to(routeLink('admin.docs.edit', $doc))->withSuccess(__('docs.updated'));
    }
}
