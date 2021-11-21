<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MediaCollectionRequest;
use App\Http\Requests\Admin\MediaLibraryRequest;
use App\Models\Media;
use App\Models\MediaLibrary;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MediaLibraryController extends Controller
{
    /**
     * Return the media library.
     */
    public function index(): View
    {
        return view('admin.media.index', [
            'media' => Media::query()->with('library')->orderBy('posted_at', 'desc')->get()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($locale, Media $medium): Media
    {
        return $medium;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $libraries = MediaLibrary::query()->groupBy('collection_name', 'id')->orderBy('collection_name')
            ->pluck('collection_name', 'id')->toArray();

        $libraries = [null => 'Select collection...'] + $libraries;

        return view('admin.media.create', compact('libraries'));
    }

    public function createCollection(): View
    {
        return view('admin.media.create_collection');
    }

    public function storeCollection($locale, MediaCollectionRequest $request): RedirectResponse
    {
        if ($request->filled('collection_name')) {
            $collectionName = $request->input('collection_name');
        }

        MediaLibrary::firstOrCreate(['collection_name' => $collectionName]);

        return redirect()->to(routeLink('admin.media.collections'))->withSuccess(__('media.created_collection'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($locale, MediaLibraryRequest $request, Media $media): RedirectResponse
    {
        $image = $request->file('image');
        $name = $image->getClientOriginalName();

        if ($request->filled('name')) {
            $name = $request->input('name');
        }

        $library = MediaLibrary::query()->find($request->input('collection'));
        if (!$library) {
            $library = MediaLibrary::firstOrCreate([
                'collection_name' => ' - Default - ',
                'default' => 1
            ]);
        }

        $library->addMedia($image)
            ->usingName($name)->toMediaCollection($library->collection_name);

        return redirect()->to(routeLink('admin.media.index'))->withSuccess(__('media.created'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($locale, Media $medium): RedirectResponse
    {
        $medium->delete();

        return redirect()->to(routeLink('admin.media.index'))->withSuccess(__('media.deleted'));
    }

    public function destroyCollection($locale, MediaLibrary $collection): RedirectResponse
    {
        $collection->delete();

        return redirect()->to(routeLink('admin.media.index'))->withSuccess(__('media.deleted_collection'));
    }

    public function collections(): Factory|\Illuminate\Contracts\View\View|Application
    {
        $mediaCollections = MediaLibrary::query()->with('medias')
            ->orderBy('collection_name')->get()->toArray();

        return view('admin.media.index_collections', compact('mediaCollections'));
    }

    public function editCollection($locale, MediaLibrary $collection): View
    {
        return view('admin.media.edit_collection', [
            'collection' => $collection
        ]);
    }

    public function updateCollection($locale, MediaCollectionRequest $request, MediaLibrary $collection)
    {
        $collection->update($request->only(['collection_name']));
        $collection->refresh();
        return redirect()->to(routeLink('admin.media.edit_collection', ['collection' => $collection]))
            ->withSuccess(__('media.collection_updated'));
    }
}