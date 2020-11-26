<?php

namespace App\Exports;

use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Files\LocalTemporaryFile;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class WordsExport implements  WithEvents
{
    use Exportable;

    public function registerEvents(): array 
    {
        $types = config("config.types_array");
        $templateFilePath = public_path() . config("config.export_template");

        return [
            BeforeExport::class => function (BeforeExport $event) use ($types, $templateFilePath) {
                $event->writer->reopen(new LocalTemporaryFile($templateFilePath), EXCEL::XLSX);
                $sheet = $event->writer->getSheetByIndex(0);
                $rowCount = config("config.number_of_records_in_export_file");
                $validationCate = $sheet->getDelegate()->getCell("B2")->getDataValidation();
                $validationCate->setType(DataValidation::TYPE_LIST);
                $validationCate->setErrorStyle(DataValidation::STYLE_INFORMATION);
                $validationCate->setAllowBlank(false);
                $validationCate->setShowDropDown(true);
                $validationCate->setFormula1('"' . implode(',', $types) . '"');
                for($i = 2; $i <= $rowCount; $i++) {
                    $sheet->getDelegate()->getCell("B$i")->setDataValidation(clone $validationCate);
                }

                return $event->getWriter()->getSheetByIndex(0);
            },
            BeforeWriting::class => function (BeforeWriting $event) {
                $event->writer->getDelegate()->removeSheetByIndex(1);
            },
        ];
    }
}
