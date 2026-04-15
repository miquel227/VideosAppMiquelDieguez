<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VideosManageController extends Controller
{
    public static function testedBy(): string
    {
        return \Tests\Feature\Videos\VideosManageControllerTest::class;
    }

    public function index(): View
    {
        $videos = Video::latest()->get();

        return view('videos.manage.index', compact('videos'));
    }

    public function show(Video $video): View
    {
        return view('videos.manage.show', compact('video'));
    }

    public function create(): View
    {
        return view('videos.manage.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'url'         => 'required|url|max:255',
        ]);

        $validated['published_at'] = now();

        Video::create($validated);

        return redirect()->route('videos.manage');
    }

    public function edit(Video $video): View
    {
        return view('videos.manage.edit', compact('video'));
    }

    public function update(Request $request, Video $video): RedirectResponse
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'url'         => 'required|url|max:255',
        ]);

        $video->update($validated);

        return redirect()->route('videos.manage');
    }

    public function delete(Video $video): View
    {
        return view('videos.manage.delete', compact('video'));
    }

    public function destroy(Video $video): RedirectResponse
    {
        $video->delete();

        return redirect()->route('videos.manage');
    }
}
