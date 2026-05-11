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
        // TODO (L1.d): Load all plants (e.g. Plant::orderBy('name')->get()) and
        //              return view('plants.index', compact('plants')).
        return view('welcome');
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

        // TODO (L3.e): persist the plant (e.g. Plant::create([...$validated, 'user_id' => $request->user()->id]))
        //              after fixing the form field names (L3.f) and CSRF (L3.h) in plants/create.blade.php.

        return redirect()->back()->with('status', 'Validated (finish store + routes + CSRF).');
    }
}
