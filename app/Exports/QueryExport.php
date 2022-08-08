<?php

namespace App\Exports;

use App\Models\Query;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class QueryExport implements FromView, WithStyles
{
    use Exportable;

    public $query;

    public function __construct($query)
    {
        $this->query = $query;
    }
    public function view(): View
    {
        $query = $this->query;
        return view('admin.exports.query', compact('query'));
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
