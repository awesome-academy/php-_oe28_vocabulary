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

    public function update(Request $request, $id)
    {
        try {
            $word = Word::find($id);
            $word->update([
                'note' => trim($request->note),
                'word' => trim($request->word),
            ]);
            if (Config::get('app.locale') == 'en') {
                $newTypeId = config("config.$request->type");
                $oldTypeId = config("config.$request->oldTypeId");
            }
            else {
                $newTypeId = config("config_vi.$request->type");
                $oldTypeId = config("config_vi.$request->oldTypeId");
            };
            $word->types()->wherePivot('type_id', $oldTypeId)->updateExistingPivot($oldTypeId, [
                'type_id' => $newTypeId, 
                'meaning' => trim($request->meaning),
            ]);
        } catch (Exception $e) {
            return back()->with('message', trans('words.update_failed'));
        }

        return redirect()->route('words.index')->with('message', trans('words.update_successfully'));
    }

    public function delete($wordId, $typeId)
    {
        $checkWord = DB::table('test_word')->where([
            ['word_id', '=', $wordId],
            ['type_id', '=', $typeId],
        ])->get()->isNotEmpty();
        if ($checkWord) 
            return back()->with('message', trans('words.check_word'));
        try {
            $word = Word::find($wordId);
            $types = $word->types()->get()->toArray();
            $totalRecords = count($types);
            $word->types()->wherePivot('type_id', $typeId)->detach();
            if ($totalRecords === config("config.the_other_records")) {
                $word->delete();
            }
        } catch (Exception $e) {
            return redirect()->route('words.index')->with('message', trans('words.delete_failed'));
        }

        return redirect()->route('words.index')->with('message', trans('words.delete_successfully'));
    }

    public function fix($wordId, $typeId)
    {
        $checkWord = DB::table('test_word')->where([
            ['word_id', '=', $wordId],
            ['type_id', '=', $typeId],
        ])->get()->isNotEmpty();
        $word = Word::findOrFail($wordId);
        $meaning = $word->types()->find($typeId)->pivot->meaning;
        if (Config::get('app.locale') == 'en') {
            $type = config("config.$typeId");
        }
        else {
            $type = config("config_vi.$typeId");
        }
        $allTypes = $word->types()->get()->toArray();
        
        return view('edit_word', compact(['word', 'meaning', 'type', 'allTypes', 'check_word']));
    }
}
