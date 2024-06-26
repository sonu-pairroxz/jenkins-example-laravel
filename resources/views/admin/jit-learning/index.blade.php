@extends('admin.layouts.app')
@push('styles')
    <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Latest Notifications</h4>
                <marquee behavior="scroll" direction="up" scrollamount=3 onmouseover="this.stop();" onmouseout="this.start();">
                    @forelse ($notifications as $notification)
                        <p class="card-title-desc">
                            <a target="_blank" href="{{route('jit-learning.show', $notification->jit_learning_id)}}"> >> {{$notification->notification_text}}</a>
                        </p>
                    @empty
                    <p>No notification found.</p>
                    @endforelse
                </marquee>
            </div>
        </div>
    </div> <!-- end col -->

    <div class="col-sm-6">
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
                <form action="{{ route('import-quiz') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4">
                        <div class="custom-file text-left">
                            <input type="file" name="file" class="custom-file-input" id="customFile">
                        </div>
                    </div>
                    <button class="btn btn-sm btn-primary">Import data</button>
                </form>
            </div>
        </div>
    </div>
</div>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Quiz/JIT Learning</h4>
                <div class="page-title-right">
                    <a href="{{route('jit-learning.create')}}" type="button" class="btn btn-success waves-effect waves-light">+ Add New</a>
                    <a href="{{route('jit-learning.export')}}" type="button" class="btn btn-primary waves-effect waves-light"><i class="fas fa-file-excel"></i> Download Excel</a>
                    <a href="{{route('jit-learning.remove-all')}}" onclick="return confirm('Are you sure want to remove all JIT/Quiz learnings?')" class="btn btn-danger waves-effect waves-light"><i class="fa fa-trash" aria-hidden="true"></i> Remove All</a>
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
                    <table id="jit-learnings" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Ticket ID</th>
                            <th>ASIN</th>
                            <th>Product Name</th>
                            <th>Error Type</th>
                            <th>SIM</th>
                            <th>Node</th>
                            <th>Marketplace</th>
                            <th>Correct Code</th>
                            <th>Incorrect Code</th>
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
    <script src="{{asset('assets/js/jit.js')}}"></script>
<script>
   var datatbleurl= "{!! route('jit-learning.list.data') !!}";
</script>

@endpush
