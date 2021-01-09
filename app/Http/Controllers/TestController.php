<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Repositories\Test\TestRepositoryInterface;

class TestController extends Controller
{
    protected $testRepo;

    public function __construct(TestRepositoryInterface $testRepo)
    {
        $this->testRepo = $testRepo;
    }

    public function index()
    {
        $tests = $this->testRepo->getAllTests();
    
        return view('history', compact('tests'));
    }

    public function create()
    {
        $types = $this->testRepo->getAllTypes();
        $dates = $this->testRepo->getAllDates();
        $dates = $dates->map(function($date, $key){
            $date['created_at'] = Carbon::parse($date['created_at'])->format('Y/m/d');

            return $date;
        })->toArray();
        $dates = array_map("unserialize", array_unique(array_map("serialize", $dates)));
        
        return view('tests', compact(['types', 'dates']));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        foreach ($data['dates'] as $key => $date) {
            if (app()->getLocale() == 'en') {
                $dates[$key] = date('Y-m-d', strtotime($date));
            } 
            else {
                $dates[$key] = date('Y-m-d', strtotime(str_replace('/', '-', $date)));
            }
        }
        foreach ($data['types'] as $key => $type) {
            if (app()->getLocale() == 'en') {
                $types[$key] = config("config.$type");
            }
            else {
                $types[$key] = config("config_vi.$type");  
            }
        }
        $words = $this->testRepo->createWordsForATest($types, $dates, $data['total']);
        $timeout = Carbon::parse(now());    
        $timeout->addMinutes(config("config.timeout"));
        $test = $this->testRepo->createATest($data['level'], $data['test'], count($words), $timeout);
        foreach ($words as $word) {
            $this->testRepo->attachAWordToTestWordTable($test, $word);
        }
    
        return redirect()->route('tests.show', $test->id);
    }

    public function show(Request $request, $id)
    {
        $test = $this->testRepo->getATestWith($id, 'words.types');
        
        return view('view_test', compact('test'));
    }

    public function edit($id)
    {
        $test = $this->testRepo->getATestWith($id, 'words');

        return view('details', compact('test'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $score = 0;
        foreach ($data['answers'] as $index => $answer) {
            $result = '';
            foreach ($answer as $character) {
                $result .= $character;
            } 
            $isTrue = (int)($data['keys'][$index] == $result);
            if ($isTrue) $score++;
            $this->testRepo->updateAnswersForATest($id, $data['typeIds'][$index], $data['wordIds'][$index], [
                'answer' => $result,
                'is_true' => $isTrue,
            ]);
        }
        $test = $this->testRepo->update($id, [
            'score' => $score,
        ]);
        $total = $test->total;
        $name = $test->test;

        return view('res_test', compact(['score', 'total', 'id', 'name']));
    }

    public function destroy($id)
    {
        $this->testRepo->destroyATest($id);

        return back()->with('message', trans('history.message'));
    }
}
