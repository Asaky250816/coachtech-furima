<?php

namespace App\Http\Controllers;

use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $query = Item::query();

        if (auth()->check()) {
            $query->where('user_id', '!=', auth()->id());
        }

        $items = $query->latest()->get();

        return view('items.index', compact('items'));
    }
}