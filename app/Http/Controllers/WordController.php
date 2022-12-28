<?php

namespace App\Http\Controllers;

use App\Http\Requests\WordRequest;
use App\Models\Language;
use App\Models\Word;

class WordController extends Controller
{
    public function index()
    {
        $words = Word::where('user_id', auth()->user()->id)->paginate(10);

        $languages = Language::get();

        return view('panel.words.index', compact('words', 'languages'));
    }

    public function store(WordRequest $request)
    {
        $user = auth()->user();

        if (!is_null(Word::where('name', $request->name)->where('user_id', $user->id)->first())) {
            return redirect()->back()->withInput()->with('warning', 'Você já adicionou essa palavra!');
        }

        Word::create([
            'language_id' => $request->language_id,
            'user_id' => $user->id,
            'name' => $request->name,
            'translation' => $request->translation
        ]);

        return redirect()->route('panel.word.index')->with('success', 'Nova palavra adicionada com sucesso!');
    }

    public function update($id, WordRequest $request)
    {
        $word = Word::find($id);

        if (is_null($word)) {
            return redirect()->back();
        }

        if (!is_null(Word::where('name', $request->name)->where('user_id', auth()->user()->id)->first())) {
            return redirect()->back()->withInput()->with('warning', 'Essa palavra já existe!');
        }

        $word->update([
            'language_id' => $request->language_id,
            'name' => $request->name,
            'translation' => $request->translation
        ]);

        return redirect()->route('panel.word.index')->with('success', 'Palavra atualizada com sucesso!');
    }

    public function delete($id)
    {
        $word = Word::find($id);

        if (is_null($word)) {
            return redirect()->back();
        }

        $word->phrases()->delete();

        $word->delete();

        return redirect()->route('panel.word.index')->with('success', 'Palavra excluida com sucesso!');
    }
}
