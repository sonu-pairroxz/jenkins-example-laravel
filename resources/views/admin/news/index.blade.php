@extends('admin.layouts.app')
@push('styles')
    <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">News</h4>
                <div class="page-title-right">
                    <a href="{{route('news.create')}}" type="button" class="btn btn-success waves-effect waves-light">+ Add New</a>
                    <a href="{{route('news.export')}}" type="button" class="btn btn-primary waves-effect waves-light"><i class="fas fa-file-excel"></i> Download Excel</a>
                    <a href="{{route('news.remove-all')}}" onclick="return confirm('Are you sure want to remove all JIT/Quiz learnings?')" class="btn btn-danger waves-effect waves-light"><i class="fa fa-trash" aria-hidden="true"></i> Remove All</a>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(\Session::get('error_message'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ \Session::get('error_message') }}
                        </div>
                    @endif
                    @if(\Session::get('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ \Session::get('message') }}
                        </div>
                    @endif
                    <table id="news" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Title</th>
                            <th>MP</th>
                            <th>Type</th>
                            <th>Date of Publish</th>
                            <th>Date Of change Applied</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection
@push('scripts')
    <script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>
    <script src="{{asset('assets/js/news.js')}}"></script>
<script>
   var datatbleurl= "{!! route('news.list.data') !!}";
</script>

@endpush
