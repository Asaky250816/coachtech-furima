<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $items = auth()->user()
            ->items()
            ->with('purchase')
            ->latest()
            ->get();

        return view('profiles.index', compact('items'));
    }

    public function edit()
    {
        return view('profiles.edit');
    }
}
