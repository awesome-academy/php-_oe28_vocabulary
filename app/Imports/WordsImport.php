<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;
use Exception;

class WordsImport implements ToCollection, WithStartRow
{
    public function collection(Collection $rows)
    {    
        $rows = $rows->toArray();
        sort($rows);
        foreach ($rows as $key => $row) {
            if (($key >= 1) && ($row[0] == $rows[$key-1][0]) && ($row[1] == $rows[$key-1][1])) {
                unset($rows[$key-1]);
            }
        }
        $user = Auth::user();
        DB::beginTransaction();
        try {
            foreach ($rows as $key => $row) {
                $word = $user->words()->firstOrCreate([
                    'word' => $row[0],
                ]);
                if ($word->wasRecentlyCreated) {
                    $word->types()->attach($row[1], ['meaning' => $row[2]]);
                }
                else {
                    if (!$word->types()->find($row[1])) {
                        $word->types()->attach($row[1], ['meaning' => $row[2]]);
                    }
                }   
            }
            DB::commit();
        }
        catch (Exception $e) {
            DB::rollback();
        }

        return back()->with('message', trans('words.add_successfully'));
    }

    public function startRow(): int
    {
        return config("config.start_row");
    }
}
