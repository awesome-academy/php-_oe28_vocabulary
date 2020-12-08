<?php

namespace App\Http\Controllers;

use Exception;
use App\Imports\WordsImport; 
use App\Exports\WordsExport; 
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Config;
use App\Repositories\Word\WordRepositoryInterface;

class WordController extends Controller
{
    protected $wordRepo;

    public function __construct(WordRepositoryInterface $wordRepo)
    {
        $this->wordRepo = $wordRepo;
    }

    public function index()
    {
        $words = $this->wordRepo->getAllWordsWith('types');
        
        return view('words', compact('words'));
    }

    public function create()
    {
        return view('create_word');
    }

    public function store(Request $request)
    {
        if (count(array_unique($request->types)) != count($request->types)) {
            return back()->with('message', trans('words.err_types'));
        }
        try {
            $word = $this->wordRepo->createWord([
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
                $this->wordRepo->attachTypeWordTable($word, $typeId, ['meaning' => $meaning]);
            }
        } catch (Exception $e) {
            return back()->with('message', trans('words.add_failed'));
        }

        return redirect()->route('words.index')->with('message', trans('words.add_successfully'));
    }

    public function update(Request $request, $id)
    {
        try {
            $word = $this->wordRepo->update($id, [
                'note' => trim($request->note),
                'word' => trim($request->word),
            ]);
            if (Config::get('app.locale') == 'en') {
                $newTypeId = config("config.$request->type");
                $oldTypeId = config("config.$request->oldTypeId");
            } else {
                $newTypeId = config("config_vi.$request->type");
                $oldTypeId = config("config_vi.$request->oldTypeId");
            };
            $this->wordRepo->updateTypeWordTable($word, $oldTypeId, [
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
        $checkWord = $this->wordRepo->checkTheWord($wordId, $typeId);
        if ($checkWord) 
            return back()->with('message', trans('words.check_word'));
        try {
            $types = $this->wordRepo->getAWordWithTypes($wordId);
            $totalRecords = count($types);
            $this->wordRepo->detachTypeWordTable($wordId, $typeId);
            if ($totalRecords == config("config.the_other_records")) {
                $this->wordRepo->delete($wordId);
            }
        } catch (Exception $e) {
            return redirect()->route('words.index')->with('message', trans('words.delete_failed'));
        }

        return redirect()->route('words.index')->with('message', trans('words.delete_successfully'));
    }

    public function fix($wordId, $typeId)
    {
        $checkWord = $this->wordRepo->checkTheWord($wordId, $typeId);
        $word = $this->wordRepo->find($wordId);
        $meaning = $this->wordRepo->getMeaningOfAWord($word, $typeId);
        if (Config::get('app.locale') == 'en') {
            $type = config("config.$typeId");
        }
        else {
            $type = config("config_vi.$typeId");
        }
        $allTypes = $this->wordRepo->getAWordWithTypes($word);
        
        return view('edit_word', compact(['word', 'meaning', 'type', 'allTypes', 'checkWord']));
    }

    public function import(Request $request)
    {    
        Excel::import(new WordsImport, $request->file('import'));

        return back();
    }

    public function export() 
    {
       return Excel::download(new WordsExport, config("config.export_file_name"));
    }
}
