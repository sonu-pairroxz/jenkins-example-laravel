@extends('admin.layouts.app')
@push('styles')
    <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')

<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Latest Notifications</h4>
                <marquee behavior="scroll" direction="up" scrollamount=3 onmouseover="this.stop();" onmouseout="this.start();">
                    @forelse ($notifications as $notification)
                        <p class="card-title-desc">
                            <a target="_blank" href="{{route('query.edit', $notification->query_id)}}"> >> {{$notification->notification_text}}</a>
                        </p>
                    @empty
                    <p>No notification found.</p>
                    @endforelse
                </marquee>
            </div>
        </div>
    </div> <!-- end col -->
</div>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Ask a query</h4>
                <div class="page-title-right">
                    <a href="{{route('query.create')}}" type="button" class="btn btn-success waves-effect waves-light">+ Add New</a>
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
                    <table id="queries" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Ticket ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>ASIN</th>
                            <th>Work Stream</th>
                            <th>Marketplace</th>
                            <th>Tariff Node</th>
                            <th>Manager</th>
                            <th>Ruling Referred</th>
                            <th>External Links</th>
                            <th>Document Referred</th>
                            <th>No of NFA Parked</th>
                            <th>ITK</th>
                            <th>Comment</th>
                            <th>Resolver Comment</th>
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
    <script src="{{asset('assets/js/query.js')}}"></script>
<script>
   var datatbleurl= "{!! route('query.list.data') !!}";
</script>

@endpush
