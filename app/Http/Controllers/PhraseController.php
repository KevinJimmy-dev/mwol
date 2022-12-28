<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhraseRequest;
use App\Models\Phrase;
use App\Models\Word;
use Illuminate\Http\Request;

class PhraseController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $phrases = Phrase::where('user_id', $user->id)->paginate(10);

        $words = Word::where('user_id', $user->id)->get();

        return view('panel.phrases.index', compact('phrases','words'));
    }

    public function store(PhraseRequest $request)
    {
        $user = auth()->user();

        if (!is_null(Phrase::where('phrase', $request->phrase)->where('user_id', $user->id)->first())) {
            return redirect()->back()->withInput()->with('warning', 'Você já adicionou essa frase!');
        }

        Phrase::create([
            'user_id' => $user->id,
            'word_id' => $request->word_id,
            'phrase' => $request->phrase,
            'translation' => $request->translation
        ]);

        return redirect()->route('panel.phrase.index')->with('success', 'Nova frase adicionada com sucesso!');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'word_id_update' => ['required', 'exists:words,id'],
            'phrase_update' => ['required'],
            'translation_update' => ['required'],
        ], [
            'word_id_update.required' => 'Você precisa vincular a uma palavra especifica!',
            'word_id_update.exists' => 'Essa palavra não existe né?',
            'phrase_update.required' => 'Você precisa preencher o campo com a frase!',
            'translation_update.required' => 'Você precisa preencher o campo da tradução!',
        ]);

        $phrase = Phrase::find($id);

        if (is_null($phrase)) {
            return redirect()->back();
        }

        if (!is_null(Phrase::where('phrase', $request->phrase)->where('user_id', auth()->user()->id)->first())) {
            return redirect()->back()->withInput()->with('warning', 'Essa frase já existe!');
        }

        $phrase->update([
            'word_id' => $request->word_id_update,
            'phrase' => $request->phrase_update,
            'translation' => $request->translation_update
        ]);

        return redirect()->route('panel.phrase.index')->with('success', 'Frase atualizada com sucesso!');
    }

    public function delete($id)
    {
        $phrase = Phrase::find($id);

        if (is_null($phrase)) {
            return redirect()->back();
        }

        $phrase->delete();

        return redirect()->route('panel.phrase.index')->with('success', 'Frase excluida com sucesso!');
    }
}
