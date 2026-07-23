<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function update(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:255',
                'postal_code' => 'required|max:8',
                'address' => 'required|max:255',
                'building' => 'nullable|max:255',
            ],
            [],
            [
                'name' => 'お名前',
                'postal_code' => '郵便番号',
                'address' => '住所',
                'building' => '建物名',
            ]
        );

        $user = auth()->user();

        $user->update([
            'name' => $request->name,
        ]);

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'postal_code' => $request->postal_code,
                'address' => $request->address,
                'building' => $request->building,
            ]
        );

        return redirect()->route('profile.index');
    }
}
