<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\HtusImport;
use App\Models\Htus;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ImportController extends Controller
{
    public function fileImport(Request $request)
    {
        Excel::import(new HtusImport, $request->file('file')->store('temp'));
        return back();
    }

    public function allHtus(Request $request)
    {
        if ($request->ajax()) {
            $htuses = Htus::latest()->get();

            return DataTables::of($htuses)
                ->addIndexColumn()
                ->addColumn('image', function($htuses){
                    return "<img src='".$htuses->image."' alt='".$htuses->image."' />";
                })
                ->addColumn('classification_justification', function($htuses){
                    return Str::limit($htuses->classification_justification,30);
                })
                ->rawColumns(['image'])
                ->make(true);
        }

        return view('admin.dashboard');
    }
}
