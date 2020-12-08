<?php
namespace App\Repositories\Word;

use App\Repositories\BaseRepository;
use App\Repositories\Word\WordRepositoryInterface;
use App\Models\Word;
use Illuminate\Support\Facades\DB;

class WordRepository extends BaseRepository implements WordRepositoryInterface
{
    public function getModel()
    {
        return Word::class;
    }

    public function getAllWordsWith($data)
    {
        return parent::getUser()->words()->with($data)->get();
    }

    public function createWord(array $data)
    {
        return parent::getUser()->words()->create($data);
    }

    public function getTypesByTheWord($word) 
    {
        return $word->types();
    }

    public function attachTypeWordTable($word, $typeId,array $data)
    {
        return $this->getTypesByTheWord($word)->attach($typeId, $data);
    }

    public function detachTypeWordTable($id, $typeId)
    {
        $word = parent::find($id);

        return $this->getTypesByTheWord($word)->wherePivot('type_id', $typeId)->detach();
    }

    public function updateTypeWordTable($word, $oldTypeId, array $data)
    {
        return $this->getTypesByTheWord($word)->wherePivot('type_id', $oldTypeId)->updateExistingPivot($oldTypeId, $data);
    }

    public function checkTheWord($wordId, $typeId)
    {
        return DB::table('test_word')->where([
            ['word_id', '=', $wordId],
            ['type_id', '=', $typeId],
        ])->get()->isNotEmpty();
    }

    public function getAWordWithTypes($word)
    {
        return $this->getTypesByTheWord($word)->get()->toArray();
    }

    public function getMeaningOfAWord($word, $typeId)
    {
        return $this->getTypesByTheWord($word)->find($typeId)->pivot->meaning;
    }
}
