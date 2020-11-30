<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Word;
use App\Models\Test;
use Carbon\Carbon;

class TestController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tests = $user->tests->toArray(); 

        return view('history', compact('tests'));
    }

    public function create()
    {
        $types = DB::table('type_word')->select('type_id')->distinct()->get()->toArray();
        $userId = Auth::id();
        $dates = Word::select('created_at')->where('user_id', $userId)->get();
        $dates = $dates->map(function($date, $key){
            $date['created_at'] = Carbon::parse($date['created_at'])->format('Y/m/d');

            return $date;
        })->toArray();
        $dates = array_map("unserialize", array_unique(array_map("serialize", $dates)));
        
        return view('tests', compact(['types', 'dates']));
    }

    public function store(Request $request)
    {
        $level = $request->level;
        foreach ($request->dates as $key => $date) {
            if (app()->getLocale() == 'en') {
                $dates[$key] = date('Y-m-d', strtotime($date));
            } 
            else {
                $dates[$key] = date('Y-m-d', strtotime(str_replace('/', '-', $date)));
            }
        }
        foreach ($request->types as $key => $type) {
            if (app()->getLocale() == 'en') {
                $types[$key] = config("config.$type");
            }
            else {
                $types[$key] = config("config_vi.$type");  
            }
        }
        $words = DB::table('words')
            ->join('type_word', 'words.id', '=', 'type_word.word_id')
            ->select('words.word', 'type_word.meaning', 'type_word.type_id', 'words.id')
            ->whereIn('type_word.type_id', $types)
            ->whereIn(DB::raw("DATE(words.created_at)"), $dates)
            ->inRandomOrder()
            ->limit($request->total)
            ->get();
        $user = Auth::user();
        $timeout = Carbon::parse(now());
        $timeout->addMinutes(5);
        $test = $user->tests()->create([
            'option_level' => $level,
            'test' => $request->test,
            'total' => count($words),
            'timeout' => $timeout,
        ]);
        foreach ($words as $word) {
            $test->words()->attach($word->id, ['type_id' => $word->type_id]);
        }

        return redirect()->route('tests.show', $test->id);
    }

    public function show(Request $request, $id)
    {
        $test = Test::findOrFail($id);
        $test = $test->load('words.types')->toArray();
        
        return view('view_test', compact('test'));
    }

    public function edit($id)
    {
        $test = Test::findOrFail($id);
        $test = $test->load('words')->toArray();
       
        return view('details', compact('test'));
    }

    public function update(Request $request, $id)
    {
        $test = Test::findOrFail($id);
        $answers = $request->answers;
        $key = $request->keys;
        $typeIds = $request->typeIds;
        $wordIds = $request->wordIds;
        $score = 0;
        foreach ($answers as $index => $answer) {
            $result = '';
            foreach ($answer as $character) {
                $result .= $character;
            } 
            $isTrue = (int)($key[$index] == $result);
            if ($isTrue) $score++;
            DB::table('test_word')
                ->where([
                    ['test_id', '=', $id],
                    ['type_id', '=', $typeIds[$index]],
                    ['word_id', '=', $wordIds[$index]],
                ])
                ->update([
                    'answer' => $result,
                    'is_true' => $isTrue,
                ]);
        }
        $test->update([
            'score' => $score,
        ]);
        $total = $test->total;
        $name = $test->test;

        return view('res_test', compact(['score', 'total', 'id', 'name']));
    }

    public function destroy($id)
    {
        $test = Test::findOrFail($id);
        $test->delete();
        $test->words()->detach();

        return back()->with('message', trans('history.message'));
    }
}
