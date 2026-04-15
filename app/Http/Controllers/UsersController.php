<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsersController extends Controller
{
    public static function testedBy(): string
    {
        return \Tests\Feature\Users\UsersTest::class;
    }

    public function index(Request $request): View
    {
        $search = $request->get('search', '');

        $users = User::query()
            ->when($search, function ($query, string $s): void {
                $query->where('name', 'like', "%{$s}%")
                      ->orWhere('email', 'like', "%{$s}%");
            })
            ->latest()
            ->get();

        return view('users.index', compact('users', 'search'));
    }

    public function show(User $user): View
    {
        $videos = $user->videos()->latest()->get();

        return view('users.show', compact('user', 'videos'));
    }
}
