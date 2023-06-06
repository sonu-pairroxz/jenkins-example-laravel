@extends("admin.layouts.app")
@section('title', 'Dashboard')
@push('styles')
    <style>
        .page {
            display: grid;
        }
        .grid-header {
            background-color: #d7d7d7;
            text-align: left;
            padding: 13px;
            font-size: medium;
        }
    </style>
@endpush
@section("content")

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Details</h4>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-primary" href="{{route('jit-learning.index')}}">Back</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <h2>Ticket ID: <strong>{{$data->ticket_id ?? ""}}</strong></h2>
        <dic class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">ASIN</label>
                        <p>{{ $data->asin ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Product Name</label>
                        <p>{{ $data->product_name ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Error Type</label>
                        <p>{{ $data->error_type ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">SIM</label>
                        <p>{{ $data->sim ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Node</label>
                        <p>{{ $data->node ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Marketplace</label>
                        <p>{{ $data->marketplace ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Correct Code</label>
                        <p>{{ $data->correct_code ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Incorrect Code</label>
                        <p>{{ $data->incorrect_code ?? "n\a"}}</p>
                    </div>


                    <div class="col-md-12 page">
                        <label for="inputZip" class="form-label grid-header">Learnings</label>
                        <p>{!! $data->learning ?? "n\a" !!}</p>
                    </div>

                    <div class="col-md-12 page">
                        <label for="inputZip" class="form-label grid-header">Correct Methodology</label>
                        <p>{!! $data->correct_methodology ?? "n\a" !!}</p>
                    </div>

                    <div class="col-md-12 page">
                        <label for="inputZip" class="form-label grid-header">Reference</label>
                        <p>{!! $data->reference ?? "n\a" !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {

    });
    </script>
@endpush
