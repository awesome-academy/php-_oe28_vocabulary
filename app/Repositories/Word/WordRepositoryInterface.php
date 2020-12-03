<?php
namespace App\Repositories\Word;

interface WordRepositoryInterface
{
    /**
     * Lấy model
     * @return mixed
     */
    public function getModel();

    /**
     * Lấy tất cả các words dùng eager loading
     * @param array $data
     * @return mixed
     */
    public function getAllWordsWith($data);

    /**
     * Thêm word
     * @param array $data
     * @return mixed
     */
    public function createWord(array $data);
    
    /**
     * Thêm 1 word vào bảng trung gian
     * @param $word
     * @param $typeId
     * @param array $data
     * @return mixed
     */
    public function attachTypeWordTable($word, $typeId, array $data);

    /**
     * Xoá 1 word khỏi bảng trung gian
     * @param $id
     * @param $typeId
     * @return mixed
     */
    public function detachTypeWordTable($id, $typeId);

    /**
     * Cập nhật 1 word ở bảng trung gian
     * @param $word
     * @param $oldTypeId
     * @param array $data
     * @return mixed
     */
    public function updateTypeWordTable($word, $oldTypeId, array $data);

    /**
     * Kiểm tra 1 word có trong bảng trung gian không
     * @param $wordId
     * @param $typeId
     * @return mixed
     */
    public function checkTheWord($wordId, $typeId);

    /**
     * Lấy các types của 1 word
     * @param $wordId
     * @return mixed
     */
    public function getTypesByTheWord($word);

    /**
     * Lấy 1 word sử dụng eager loading
     * @param $word
     * @return mixed
     */
    public function getAWordWithTypes($word);

    /**
     * Lấy tất cả các nghĩa của 1 word
     * @param $word
     * @param $typeId
     * @return mixed
     */
    public function getMeaningOfAWord($word, $typeId);
}
