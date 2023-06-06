<?php

namespace App\Exports;

use App\Models\Query;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class NewsExport implements FromView, WithStyles
{
    use Exportable;

    public $news;

    public function __construct($news)
    {
        $this->news = $news;
    }
    public function view(): View
    {
        $news = $this->news;
        return view('admin.exports.news', compact('news'));
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
