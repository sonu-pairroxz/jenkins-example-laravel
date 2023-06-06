<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class JitLearningExport implements FromView, WithStyles
{
    use Exportable;

    public $jitlearning;

    public function __construct($jitlearning)
    {
        $this->jitlearning = $jitlearning;
    }
    public function view(): View
    {
        $jitlearning = $this->jitlearning;
        return view('admin.exports.jit-learning', compact('jitlearning'));
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1    => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => ['fillType' => 'solid', 'color' => ['rgb' => 'bfbfbf']]
            ],
        ];
    }
}
