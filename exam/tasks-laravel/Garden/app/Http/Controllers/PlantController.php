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
        $plants = Plant::query()->orderBy('name')->get();

        // TODO (L1): return the `plants.index` Blade and pass `plants` (e.g. compact('plants')).
        $plants = Plant::query()->orderBy('name')->get();
        return view('plants.index', compact('plants'));
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

        // TODO (L3): persist the plant (Plant::create / similar) after fixing the form field names and CSRF.

        return redirect()->back()->with('status', 'Validated (finish store + routes + CSRF).');
    }
}
