<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\HtusImport;
use App\Models\Htus;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\SimpleExcel\SimpleExcelReader;
use Yajra\DataTables\Facades\DataTables;
use App\Jobs\ImportJob;
use Illuminate\Support\Facades\Storage;

class ImportController extends Controller
{
    public function fileImport(Request $request)
    {
        try {
            if ($request->hasFile('file')) {
                $file = Storage::disk('public')->put(
                    'files',
                    $request->file('file')
                );
                // dd($file);
                Log::info('File Path: ' . Storage::path($file));
                //Excel::import(new HtusImport(), $request->file('file'));
                //(new HtusImport)->queue($request->file('file'));
                dispatch_sync(new ImportJob(Storage::path($file)));
                // SimpleExcelReader::create(
                //     Storage::path($file),
                //     'xlsx'
                // )
                //     ->getRows()
                //     ->each(function (array $rowProperties) {
                //         Htus::updateOrCreate(
                //             [
                //                 'ruling_reference' =>
                //                     $rowProperties['ruling_reference'],
                //             ],
                //             [
                //                 'id' => Str::uuid(),
                //                 'ruling_reference' =>
                //                     $rowProperties['ruling_reference'],
                //                 'issuing_country' =>
                //                     $rowProperties['issuing_country'],
                //                 'start_date_of_validity' =>
                //                     $rowProperties['start_date_of_validity'],
                //                 'end_date_of_validity' =>
                //                     $rowProperties['end_date_of_validity'],
                //                 'nomenclature_code' =>
                //                     $rowProperties['nomenclature_code'],
                //                 'classification_justification' =>
                //                     $rowProperties[
                //                         'classification_justification'
                //                     ],
                //                 'short_nomenclature_code' =>
                //                     $rowProperties['short_nomenclature_code'],
                //                 'language' => $rowProperties['language'],
                //                 'place_of_issue' =>
                //                     $rowProperties['place_of_issue'],
                //                 'date_of_issue' =>
                //                     $rowProperties['date_of_issue'],
                //                 'name_address' =>
                //                     $rowProperties['name_address'],
                //                 'description_0f_goods' =>
                //                     $rowProperties['description_0f_goods'],
                //                 'keywords' => $rowProperties['keywords'],
                //                 'eccn' => $rowProperties['eccn'],
                //                 'image_url' => $rowProperties['image_url'],
                //                 'amazon_doc' => $rowProperties['amazon_doc'],
                //                 'chapter_note' =>
                //                     $rowProperties['chapter_note'],
                //                 'comments' => $rowProperties['comments'],
                //                 'short_description' =>
                //                     $rowProperties['short_description'],
                //             ]
                //         );
                //     });
                return back()->with([
                    'message' =>
                        'File has been uploaded successfully. The file is being processed in the background',
                ]);
            } else {
                return back()->with([
                    'error_message' => 'Kindly choose file to import.',
                ]);
            }
        } catch (Exception $e) {
            Log::error($e);
            return back()->with([
                'error_message' => 'Oops! Something went wrong. Try again.',
            ]);
        }
    }

    public function allHtus(Request $request)
    {
        if ($request->ajax()) {
            $htuses = Htus::latest();

            return DataTables::of($htuses)
                ->filter(function ($instance) use ($request) {
                    if ($request->has('search')) {
                        $instance
                            ->where(
                                'ruling_reference',
                                'like',
                                "%{$request->get('search')}%"
                            )
                            ->orWhere(
                                'nomenclature_code',
                                'like',
                                "%{$request->get('search')}%"
                            )
                            ->orWhere(
                                'classification_justification',
                                'like',
                                "%{$request->get('search')}%"
                            )
                            ->orWhere(
                                'place_of_issue',
                                'like',
                                "%{$request->get('search')}%"
                            )
                            ->orWhere(
                                'name_address',
                                'like',
                                "%{$request->get('search')}%"
                            )
                            ->orWhere(
                                'description_0f_goods',
                                'like',
                                "%{$request->get('search')}%"
                            )
                            ->orWhere(
                                'keywords',
                                'like',
                                "%{$request->get('search')}%"
                            )
                            ->orWhere(
                                'eccn',
                                'like',
                                "%{$request->get('search')}%"
                            )
                            ->orWhere(
                                'chapter_note',
                                'like',
                                "%{$request->get('search')}%"
                            )
                            ->orWhere(
                                'comments',
                                'like',
                                "%{$request->get('search')}%"
                            );
                    }
                })
                ->addColumn('chapter_note', function ($htuses) {
                    $ch_str = '';
                    if (!empty($htuses->chapter_note)) {
                        $chapter_notes = explode(',', $htuses->chapter_note);
                        if (
                            is_array($chapter_notes) &&
                            !empty($chapter_notes)
                        ) {
                            foreach ($chapter_notes as $cn) {
                                $ch_str .=
                                    "<a href='javascript:void(0);' data-id='".$cn."' onClick='showPDF(this);'><i class='uil-invoice'></i></a> &nbsp;&nbsp;";
                            }
                        }
                    }
                    return $ch_str;
                })
                ->addColumn('amazon_doc', function ($htuses) {
                    $ad_str = '';
                    if (!empty($htuses->amazon_doc)) {
                        $amazon_docs = explode(',', $htuses->amazon_doc);
                        if (is_array($amazon_docs) && !empty($amazon_docs)) {
                            foreach ($amazon_docs as $cn) {
                                $ad_str .=
                                    "<a href='javascript:void(0);' data-id='".$cn."' onClick='showPDF(this);'><i class='uil-invoice'></i></a> &nbsp;&nbsp;";
                            }
                        }
                    }
                    return $ad_str;
                })
                ->addColumn('image', function ($htuses) {
                    $image = "<img src='" .
                    $htuses->image_url .
                    "' height='50' width='50' alt='" .
                    $htuses->image .
                    "' />";
                    return "<a href='javascript:void(0);' data-id='".$htuses->image_url."' onClick='showImageModal(this);'>".$image."</a>";
                })
                ->addColumn('short_description', function ($htuses) {
                    return Str::limit($htuses->short_description);
                })
                ->addColumn('keywords', function ($htuses) {
                    return wordwrap($htuses->keywords, 50, '<br \>', true);
                })
                ->addColumn('action', function ($htuses) {
                    return '<button type="button" class="btn btn-success btn-sm" id="getEditProductData" data-id="' .
                        $htuses->id .
                        '">Edit</button>
                        <button type="button" data-id="' .
                        $htuses->id .
                        '" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>
                        <a class="btn btn-warning btn-sm" href="' .
                        route('getDetail', $htuses->id) .
                        '">View</a>';
                })
                ->rawColumns(['image', 'action', 'chapter_note', 'amazon_doc','keywords'])
                ->make(true);
        }

        return view('admin.dashboard');
    }

    public function update(Request $request, $id)
    {
        try {
            $data = Htus::find($id);
            if (!$data) {
                return response()->json([
                    'status' => false,
                    'message' => 'Item not found.',
                ]);
            }
            $data->comments = $request->comments ?? 'n\a';
            $data->save();

            return response()->json(['status' => true]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    public function get(Request $request, $id)
    {
        $data = Htus::find($id);
        $html = '';
        if ($data) {
            $html = '<div class="form-group">';
            $html .=
                '<input type="text" class="form-control" id="comments" name="comment" value="' .
                $data->comments .
                '" />';
            $html .= '</div>';
        }

        return response()->json(['html' => $html]);
    }

    public function getDetail(Request $request, $id)
    {
        $data = Htus::find($id);
        if (!$data) {
            return back();
        }
        return view('admin.item', compact('data'));
    }

    public function delete(Request $request, $id)
    {
        $data = Htus::find($id);
        if ($data) {
            $data->delete();
        }

        return response()->json(['html' => '']);
    }

    public function removeAll(Request $request)
    {
        try {
            Htus::query()->delete();
            return redirect(route('admin.dashboard'))->with([
                'message' => 'All data removed successfully',
            ]);
        } catch (Exception $e) {
            Log::error($e);
            return back()->with([
                'error_message' => 'Oops! Something went wrong. Try again.',
            ]);
        }
    }
}
