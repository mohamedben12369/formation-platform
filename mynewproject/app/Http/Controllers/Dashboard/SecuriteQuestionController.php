<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SecuriteQuestion;
use Exception;

class SecuriteQuestionController extends Controller
{    public function index()
    {
        $questions = SecuriteQuestion::all();
        return view('dashboard.securite_questions.index', compact('questions')); // Fixed view path
    }

    public function create()
    {
        return view('dashboard.securite_questions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255|unique:securite_question,question',
        ]);

        try {
            SecuriteQuestion::create([
                'question' => $request->question,
            ]);
            return redirect()->route('dashboard.securite-questions.index')->with('success', 'Question de sécurité ajoutée avec succès.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Échec de l\'ajout de la question de sécurité.');
        }
    }

    public function edit($id)
    {
        $question = SecuriteQuestion::findOrFail($id);
        return view('dashboard.securite_questions.edit', compact('question'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string|max:255|unique:securite_question,question,' . $id,
        ]);

        try {
            $question = SecuriteQuestion::findOrFail($id);
            $question->update(['question' => $request->question]);
            return redirect()->route('dashboard.securite-questions.index')->with('success', 'Question de sécurité mise à jour avec succès.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Échec de la mise à jour de la question de sécurité.');
        }
    }    public function destroy($id)
    {
        try {
            $question = SecuriteQuestion::findOrFail($id);
            $question->delete();
            return redirect()->route('dashboard.securite-questions.index')->with('success', 'Question de sécurité supprimée avec succès.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Échec de la suppression de la question de sécurité.');
        }
    }
}
