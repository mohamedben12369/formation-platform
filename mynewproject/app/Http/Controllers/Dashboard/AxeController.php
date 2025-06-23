<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Axe;
use Illuminate\Http\Request;

class AxeController extends Controller
{
    public function index()
    {
        $axes = Axe::all();
        return view('axes', compact('axes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Axe::create($validated);

        return redirect()->route('dashboard.axes.index')
            ->with('success', 'Axe créé avec succès.');
    }

    public function update(Request $request, Axe $axe)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $axe->update($validated);

        return redirect()->route('dashboard.axes.index')
            ->with('success', 'Axe mis à jour avec succès.');
    }

    public function destroy(Axe $axe)
    {
        $axe->delete();

        return redirect()->route('dashboard.axes.index')
            ->with('success', 'Axe supprimé avec succès.');
    }
} 