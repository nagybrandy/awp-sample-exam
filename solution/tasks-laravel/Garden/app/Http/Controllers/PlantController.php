<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlantController extends Controller
{
    public function index(): View
    {
        $plants = Plant::query()
            ->with('creator')
            ->orderBy('name')
            ->get();

        return view('plants.index', compact('plants'));
    }

    public function mine(): View
    {
        $plants = Plant::query()
            ->where('user_id', auth()->id())
            ->with('creator')
            ->orderBy('name')
            ->get();

        return view('plants.mine', compact('plants'));
    }

    public function create(): View
    {
        return view('plants.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'spot' => ['required', 'string', 'max:200'],
            'care_note' => ['nullable', 'string', 'max:255'],
        ]);

        Plant::query()->create([
            ...$validated,
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('plants.mine')->with('status', __('Plant saved.'));
    }
}
