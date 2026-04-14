<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class VideosAppLayout extends Component
{
    public function render(): View
    {
        return view('layouts.videos-app');
    }
}
