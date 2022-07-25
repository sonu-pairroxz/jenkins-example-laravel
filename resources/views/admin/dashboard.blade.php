@extends("admin.layouts.app")
@section('title', 'Laravel | Dashboard')
@push('styles')
    <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section("content")

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Dashboard</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                            <div class="custom-file text-left">
                                <input type="file" name="file" class="custom-file-input" id="customFile">
                            </div>
                        </div>
                        <button class="btn btn-primary">Import data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Latest Transaction</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="latestorder">
                            <thead class="table-light">
                            <tr>
                                <th>S No</th>
                                <th>Ruling Reference</th>
                                <th>Issuing Country</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Nomenclature Code</th>
                                <th>Short Nomenclature Code</th>
                                <th>Classification Justification</th>
                                <th>Language</th>
                                <th>Image URL</th>
                                <th>Comments</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@push('scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- apexcharts -->
    <script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>

    <script>
        var datatbleurl = "{{route('all-htus')}}";
        var table = {};
        $(function() {
            table = $('#latestorder').DataTable({
                processing: true,
                serverSide: true,
                bDestroy: true,
                scrollX: true,
                ajax: datatbleurl,
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'ruling_reference',
                        name: 'ruling_reference'
                    },
                    {
                        data: 'issuing_country',
                        name: 'issuing_country'
                    },
                    {
                        data: 'start_date_of_validity',
                        name: 'start_date_of_validity'
                    },
                    {
                        data: 'end_date_of_validity',
                        name: 'end_date_of_validity'
                    },
                    {
                        data: 'nomenclature_code',
                        name: 'nomenclature_code'
                    },
                    {
                        data: 'short_nomenclature_code',
                        name: 'short_nomenclature_code'
                    },
                    {
                        data: 'classification_justification',
                        name: 'classification_justification'
                    },
                    {
                        data: 'language',
                        name: 'language'
                    },
                    {
                        data: 'image_url',
                        name: 'image_url'
                    },
                    {
                        data: 'comments',
                        name: 'comments'
                    }
                ]
            });
        });
    </script>
@endpush
