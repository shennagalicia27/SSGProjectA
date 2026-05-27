<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DegreeController extends Controller
{
    public function index(): View
    {
        $degrees = Degree::query()->latest()->paginate(10);

        return view('degree.index', compact('degrees'));
    }

    public function create(): View
    {
        return view('degree.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'degree_title' => ['required', 'string', 'max:255'],
        ]);

        Degree::create($data);

        return redirect()->route('degree.index')->with('success', 'Degree created successfully.');
    }

    public function show(Degree $degree): View
    {
        $degree->loadCount('students');

        return view('degree.show', compact('degree'));
    }

    public function edit(Degree $degree): View
    {
        return view('degree.edit', compact('degree'));
    }

    public function update(Request $request, Degree $degree): RedirectResponse
    {
        $data = $request->validate([
            'degree_title' => ['required', 'string', 'max:255'],
        ]);

        $degree->update($data);

        return redirect()->route('degree.index')->with('success', 'Degree updated successfully.');
    }

    public function destroy(Degree $degree): RedirectResponse
    {
        $degree->delete();

        return redirect()->route('degree.index')->with('success', 'Degree deleted successfully.');
    }
}
