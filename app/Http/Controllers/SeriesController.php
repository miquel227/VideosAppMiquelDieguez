<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SeriesController extends Controller
{
    public static function testedBy(): string
    {
        return \Tests\Feature\Series\SeriesTest::class;
    }

    public function index(Request $request): View
    {
        $search = $request->get('search', '');

        $series = Serie::query()
            ->when($search, fn ($q, $s) => $q->where('title', 'like', "%{$s}%"))
            ->latest()
            ->get();

        return view('series.index', compact('series', 'search'));
    }

    public function show(Serie $serie): View
    {
        $videos = $serie->videos()->whereNotNull('published_at')->latest('published_at')->get();

        return view('series.show', compact('serie', 'videos'));
    }
}
