<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\View\View;

class VideosController extends Controller
{
    public static function testedBy(): string
    {
        return \Tests\Feature\Videos\VideosTest::class;
    }

    public function index(): View
    {
        $videos = Video::whereNotNull('published_at')->latest('published_at')->get();

        return view('videos.index', compact('videos'));
    }

    public function show(Video $video): View
    {
        return view('videos.show', compact('video'));
    }
}
