<?php

namespace App\Imports;

use App\Models\Htus;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class HtusImport implements ToModel, WithUpserts, WithBatchInserts, WithChunkReading, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Htus([
            'ruling_reference'              => $row['ruling_reference'],
            'issuing_country'               => $row['issuing_country'],
            'start_date_of_validity'        => $this->transformDateTime($row['start_date_of_validity']),
            'end_date_of_validity'          => $this->transformDateTime($row['end_date_of_validity']),
            'nomenclature_code'             => $row['nomenclature_code'],
            'short_nomenclature_code'       => $row['short_nomenclature_code'],
            'classification_justification'  => $row['classification_justification'],
            'language'                      => $row['language'],
            'place_of_issue'                => $row['place_of_issue'],
            'date_of_issue'                 => $row['date_of_issue'],
            'name_address'                  => $row['name_address'],
            'description_0f_goods'          => $row['description_0f_goods'],
            'keywords'                      => $row['keywords'],
            'eccn'                          => $row['eccn'],
            'image_url'                     => $row['image_url'],
            'amazon_doc'                    => $row['amazon_doc'],
            'chapter_note'                  => $row['chapter_note'],
            'comments'                      => $row['comments'],
            'short_description'             => $row['short_description'],
        ]);
    }

    public function uniqueBy()
    {
        return 'ruling_reference';
    }


    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
    private function transformDateTime(string $value, string $format = 'd-m-Y')
    {
        try {
                return Carbon::instance(Date::excelToDateTimeObject($value))->format($format);
            } catch (\ErrorException $e) {
                return Carbon::createFromFormat($format, $value);
            }
    }
}
