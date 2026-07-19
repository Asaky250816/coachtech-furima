<?php

namespace App\Http\Controllers;

use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        if (request('tab') === 'mylist') {
            if (! auth()->check()) {
                $items = collect();

                return view('items.index', compact('items'));
            }

            $query = auth()->user()->likedItems();
        } else {
            $query = Item::query();

            if (auth()->check()) {
                $query->where('user_id', '!=', auth()->id());
            }
        }

        if (request('keyword')) {
            $query->where('name', 'like', '%' . request('keyword') . '%');
        }

        $items = $query->with('purchase')->latest('items.created_at')->get();
        return view('items.index', compact('items'));
    }

    public function show(Item $item)
    {
        $item->load(['purchase', 'categories', 'comments.user']);
        $item->loadCount(['likes', 'comments']);

        return view('items.show', compact('item'));
    }
}
