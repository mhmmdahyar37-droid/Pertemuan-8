<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'events' => Event::latest()->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'ticket_price' => ['required', 'integer', 'min:0'],
            'poster' => ['required', 'image', 'max:2048'],
        ]);

        $posterPath = $request->file('poster')->store('posters', 'public');

        Event::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'ticket_price' => $validated['ticket_price'],
            'poster_path' => $posterPath,
        ]);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Event berhasil disimpan dan poster sudah diunggah.');
    }
}
