<?php

namespace App\Http\Controllers;

use App\Models\Phrase;
use App\Models\User;
use App\Models\Word;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{
    public function index()
    {
        /**
         * @var User
         */
        $user = Auth::user();

        // Counters
        $counter = [
            'words' => $user->words()->count(),
            'phrases' => Phrase::leftJoin('words', 'phrases.word_id', '=', 'words.id')->where('words.user_id', $user->id)->count(),
            'languages' => Word::where('user_id', $user->id)->groupBy('language_id')->count()
        ];

        // Area Chart
        $diff = now()->diffInDays(now()->subDay(7));

        $sevenDays = now()->subDay(7);

        $days[] = $sevenDays->format('d');
        $amountDays[] = Word::where('created_at', $sevenDays->format('Y-m-d'))->where('user_id', $user->id)->count();

        for ($i = 0; $i < 7; $i++) {
            $days[] = $sevenDays->addDay(1)->format('d');
            $amountDays[] = Word::where('created_at', 'like', '%'.$sevenDays->format('Y-m-d').'%')->where('user_id', $user->id)->count();
        }

        // Pie Chart
        $languages = Word::selectRaw('languages.name as name, COUNT(words.id) as amount, languages.theme as theme, languages.hover as hover')
            ->where('user_id', $user->id)
            ->leftJoin('languages', 'words.language_id', '=', 'languages.id')
            ->groupBy('words.language_id');

        // Chart Array
        $chart = [
            'area' => [
                'days' => $days,
                'amount' => $amountDays
            ],
            'pie' => [
                'languages' => $languages->clone()->pluck('name')->toArray(),
                'amount' => $languages->clone()->pluck('amount')->toArray(),
                'theme' => $languages->clone()->pluck('theme')->toArray(),
                'hover' => $languages->clone()->pluck('hover')->toArray()
            ]
        ];

        $phrases = Phrase::where('user_id', $user->id)->orderBy('created_at', 'desc')->limit(10)->get();

        return view('panel.index', compact('counter', 'chart', 'phrases'));
    }
}
