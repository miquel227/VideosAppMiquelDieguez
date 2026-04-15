<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class VideosManageController extends Controller
{
    public static function testedBy(): string
    {
        return \Tests\Feature\Videos\VideosManageControllerTest::class;
    }

    public function index(): View
    {
        return view('videos.manage');
    }
}
