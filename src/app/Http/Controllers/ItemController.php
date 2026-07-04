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

        if (request('keyword')) {
            $query->where('name', 'like', '%' . request('keyword') . '%');
        }

        $items = $query->with('purchase')->latest()->get();

        return view('items.index', compact('items'));
    }
}