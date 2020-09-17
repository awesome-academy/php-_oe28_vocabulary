<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Word;
use App\Models\Type;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use App\Http\Requests\StoreWordRequest;

class WordController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $words = Word::with('types')->where('user_id', $userId)->orderBy('id', 'DESC')->paginate(5);
        
        return view('words', compact('words'));
    }

    public function create()
    {
        return view('create_word');
    }

    public function store(Request $request)
    {   
        $userId = Auth::id();
        $user = User::findOrFail($userId);
        $typeId = config("config.$request->type");
        $word = $user->words()->create([
            'word' => $request->word,
            'pronunciation' => 'check',
            'sound' => 'check',
            'type_id' => $typeId,
            'meaning' => $request->meaning,
            'note' => $request->note,
            'photo' => 'check',
        ]);

        return redirect()->route('words.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $word = Word::findOrFail($id);
        $type = Type::findOrFail($word->type_id);

        return view('edit_word', compact(['word', 'type']));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $word = Word::findOrFail($id);
        $word->delete();

        return redirect()->route('words.index');
    }
}
