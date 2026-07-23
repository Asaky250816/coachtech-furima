<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $items = $user->items()
            ->with('purchase')
            ->latest()
            ->get();

        $purchases = $user->purchases()
            ->with('item.purchase')
            ->latest()
            ->get();

        return view('profiles.index', compact('items', 'purchases'));
    }

    public function edit()
    {
        return view('profiles.edit');
    }
}
