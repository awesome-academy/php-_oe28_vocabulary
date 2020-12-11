<?php
namespace App\Repositories\Test;

interface TestRepositoryInterface
{
    public function getModel();

    public function getAllTests();

    public function getAllTypes();

    public function getAllDates();

    public function createWordsForATest($types, $dates, $total);

    public function createATest($level, $name, $total, $timeout);

    public function attachAWordToTestWordTable($test, $word);

    public function getATestWith($id, string $data);

    public function updateAnswersForATest($id, $typeId, $wordId, array $data);

    public function destroyATest($id);
}
