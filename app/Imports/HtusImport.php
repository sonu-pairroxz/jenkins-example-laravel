<?php

namespace App\Imports;

use App\Models\Htus;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class HtusImport implements ToModel, WithUpserts, WithBatchInserts, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Htus([
            'ruling_reference'              => $row[0],
            'issuing_country'               => $row[1],
            'start_date_of_validity'        => $row[2],
            'end_date_of_validity'          => $row[3],
            'nomenclature_code'             => $row[4],
            'short_nomenclature_code'       => $row[5],
            'classification_justification'  => $row[6],
            'language'                      => $row[7],
            'place_of_issue'                => $row[8],
            'date_of_issue'                 => $row[9],
            'name_address'                  => $row[10],
            'description_0f_goods'          => $row[11],
            'keywords'                      => $row[12],
            'eccn'                          => $row[13],
            'image_url'                     => $row[14],
            'amazon_doc'                    => $row[15],
            'chapter_note'                  => $row[16],
            'comments'                      => $row[17],
            'image'                         => $row[18]
        ]);
    }

    public function uniqueBy()
    {
        return 'code';
    }


    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
