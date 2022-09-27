<?php

namespace App\Jobs;

use App\Imports\HtusImport;
use App\Models\Htus;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\Log;
use Spatie\SimpleExcel\SimpleExcelReader;
use Illuminate\Support\Str;

class ImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Excel::import(new HtusImport(), $this->file);
        // SimpleExcelReader::create($this->file, 'xlsx')
        //     ->useHeaders([
        //         'ruling_reference',
        //         'issuing_country',
        //         'start_date_of_validity',
        //         'end_date_of_validity',
        //         'nomenclature_code',
        //         'classification_justification',
        //         'short_nomenclature_code',
        //         'language',
        //         'place_of_issue',
        //         'date_of_issue',
        //         'name_address',
        //         'description_0f_goods',
        //         'keywords',
        //         'eccn',
        //         'image_url',
        //         'amazon_doc',
        //         'chapter_note',
        //         'comments',
        //         'short_description',
        //     ])
        //     ->getRows()
        //     ->each(function (array $rowProperties) {
        //         Htus::updateOrCreate(
        //             [
        //                 'ruling_reference' =>
        //                     $rowProperties['ruling_reference'],
        //             ],
        //             [
        //                 'ruling_reference' =>
        //                     $rowProperties['ruling_reference'],
        //                 'issuing_country' => $rowProperties['issuing_country'],
        //                 'start_date_of_validity' =>
        //                     $rowProperties['start_date_of_validity'],
        //                 'end_date_of_validity' =>
        //                     $rowProperties['end_date_of_validity'],
        //                 'nomenclature_code' =>
        //                     $rowProperties['nomenclature_code'],
        //                 'classification_justification' =>
        //                     $rowProperties['classification_justification'],
        //                 'short_nomenclature_code' =>
        //                     $rowProperties['short_nomenclature_code'],
        //                 'language' => $rowProperties['language'],
        //                 'place_of_issue' => $rowProperties['place_of_issue'],
        //                 'date_of_issue' => $rowProperties['date_of_issue'],
        //                 'name_address' => $rowProperties['name_address'],
        //                 'description_0f_goods' =>
        //                     $rowProperties['description_0f_goods'],
        //                 'keywords' => $rowProperties['keywords'],
        //                 'eccn' => $rowProperties['eccn'],
        //                 'image_url' => $rowProperties['image_url'],
        //                 'amazon_doc' => $rowProperties['amazon_doc'],
        //                 'chapter_note' => $rowProperties['chapter_note'],
        //                 'comments' => $rowProperties['comments'],
        //                 'short_description' =>
        //                     $rowProperties['short_description'],
        //             ]
        //         );
        //     });
    }

    public function failed(Exception $e)
    {
        Log::info('Job failed');
        Log::info($e->getMessage());
    }
}
