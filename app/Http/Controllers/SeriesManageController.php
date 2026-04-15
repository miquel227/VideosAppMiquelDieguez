<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SeriesManageController extends Controller
{
    public static function testedBy(): string
    {
        return \Tests\Feature\Series\SeriesManageControllerTest::class;
    }

    public function index(): View
    {
        $series = Serie::latest()->get();

        return view('series.manage.index', compact('series'));
    }

    public function create(): View
    {
        return view('series.manage.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'image'          => 'nullable|string|max:255',
            'user_name'      => 'required|string|max:255',
            'user_photo_url' => 'nullable|url|max:255',
            'published_at'   => 'nullable|date',
        ]);

        Serie::create($validated);

        return redirect()->route('series.manage')->with('success', 'Sèrie creada correctament.');
    }

    public function edit(Serie $serie): View
    {
        return view('series.manage.edit', compact('serie'));
    }

    public function update(Request $request, Serie $serie): RedirectResponse
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'image'          => 'nullable|string|max:255',
            'user_name'      => 'required|string|max:255',
            'user_photo_url' => 'nullable|url|max:255',
            'published_at'   => 'nullable|date',
        ]);

        $serie->update($validated);

        return redirect()->route('series.manage')->with('success', 'Sèrie actualitzada correctament.');
    }

    public function delete(Serie $serie): View
    {
        return view('series.manage.delete', compact('serie'));
    }

    public function destroy(Serie $serie): RedirectResponse
    {
        $serie->videos()->update(['series_id' => null]);
        $serie->delete();

        return redirect()->route('series.manage')->with('success', 'Sèrie eliminada correctament.');
    }
}
