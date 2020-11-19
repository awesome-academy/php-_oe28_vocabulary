<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Test;
use App\Models\User;
use App\Models\Word;
use App\Imports\ImportWords; 
use App\Exports\WordsExport; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Config;

class WordController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);
        $words = $user->words()->with('types')->get();

        return view('words', compact('words'));
    }

    public function create()
    {
        return view('create_word');
    }

    public function store(Request $request)
    {
        $userId = Auth::id();
        if (count(array_unique($request->types)) != count($request->types)) {
            return back()->with('message', trans('words.err_types'));
        }
        try {
            $user = User::find($userId);
            $word = $user->words()->create([
                'word' => trim($request->word),
                'note' => trim($request->note),
            ]);
            $totalMeaning = count($request->meanings);
            for ($i = 0; $i < $totalMeaning; $i++) {
                $type = $request->types[$i];
                if (Config::get('app.locale') == 'en') {
                    $typeId = config("config.$type");
                }
                else $typeId = config("config_vi.$type");
                $meaning = trim($request->meanings[$i]);
                $word->types()->attach($typeId, ['meaning' => $meaning]);
            }
        } catch (Exception $e) {
            return back()->with('message', trans('words.add_failed'));
        }

        return redirect()->route('words.index')->with('message', trans('words.add_successfully'));
    }
}
