<?php

namespace App\Jobs;

use App\Models\JitLearning;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\SimpleExcel\SimpleExcelReader;
use Illuminate\Support\Str;


class ImportQuizJitLearning implements ShouldQueue
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
        SimpleExcelReader::create($this->file, 'xlsx')
            ->getRows()
            ->each(function (array $rowProperties) {
                JitLearning::updateOrCreate(
                    [
                        'asin' =>
                            $rowProperties['asin'],
                    ],
                    [
                        'id' => Str::uuid(),
                        'user_id' => auth()->guard('admin')->user()->id,
                        "ticket_id" => time().rand(10,99),
                        "asin" => $rowProperties['asin'],
                        "product_name" => $rowProperties['product_name'],
                        "keywords" => $rowProperties['keywords'],
                        "error_type" => $rowProperties['error_type'],
                        "sim" => $rowProperties['sim'],
                        "node" => $rowProperties['node'],
                        "marketplace" => $rowProperties['marketplace'],
                        "correct_code" => $rowProperties['correct_code'],
                        "incorrect_code" => $rowProperties['incorrect_code'],
                        "learning" => $rowProperties['learnings'],
                        "correct_methodology" => $rowProperties['correct_methodology'],
                        "reference" => $rowProperties['reference'],

                    ]
                );
            });
    }

    public function failed(Exception $e)
    {
        Log::info('Job failed');
        Log::info($e->getMessage());
    }
}
