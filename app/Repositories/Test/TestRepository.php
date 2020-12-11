<?php
namespace App\Repositories\Test;

use App\Repositories\BaseRepository;
use App\Repositories\Test\TestRepositoryInterface;
use App\Models\Test;
use Illuminate\Support\Facades\DB;
use App\Models\Word;

class TestRepository extends BaseRepository implements TestRepositoryInterface
{
    public function getModel()
    {
        return Test::class;
    }

    public function getAllTests()
    {
        return parent::getUser()->tests->toArray(); 
    }

    public function getAllTypes()
    {
        return DB::table('type_word')->select('type_id')->distinct()->get()->toArray();
    }

    public function getAllDates()
    {
        $userId = parent::getUser()->id;

        return Word::select('created_at')->where('user_id', $userId)->get();
    }

    public function createWordsForATest($types, $dates, $total)
    {
        return DB::table('words')
            ->join('type_word', 'words.id', '=', 'type_word.word_id')
            ->select('words.word', 'type_word.meaning', 'type_word.type_id', 'words.id')
            ->whereIn('type_word.type_id', $types)
            ->whereIn(DB::raw("DATE(words.created_at)"), $dates)
            ->inRandomOrder()
            ->limit($total)
            ->get();
    }

    public function createATest($level, $name, $total, $timeout)
    {
        $user = parent::getUser();
        $test = $user->tests()->create([
            'option_level' => $level,
            'test' => $name,
            'total' => $total,
            'timeout' => $timeout,
        ]);

        return $test;
    }

    public function attachAWordToTestWordTable($test, $word)
    {
        $test->words()->attach($word->id, ['type_id' => $word->type_id]);
    }

    public function getATestWith($id, string $data)
    {
        return Test::findOrFail($id)->load($data)->toArray();
    }

    public function findATest($id)
    {
        return Test::findOrFail($id);
    }

    public function updateAnswersForATest($id, $typeId, $wordId, array $data)
    {
        DB::table('test_word')
            ->where([
                ['test_id', '=', $id],
                ['type_id', '=', $typeId],
                ['word_id', '=', $wordId],
            ])
            ->update($data);
    }

    public function destroyATest($id)
    {
        $test = Test::findOrFail($id);
        $test->delete();
        $test->words()->detach();
    }
}
