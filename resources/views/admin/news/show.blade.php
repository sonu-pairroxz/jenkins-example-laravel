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
                    <a class="btn btn-primary" href="{{route('news.index')}}">Back</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <dic class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Title</label>
                        <p>{{ $data->title ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Marketplace</label>
                        <p>{{ $data->marketplace ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Type</label>
                        <p>{{ $data->type ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Date of publish</label>
                        <p>{{ $data->date_of_publish ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Date of change applied</label>
                        <p>{{ $data->date_of_change_applied ?? "n\a"}}</p>
                    </div>

                    <div class="col-md-12 page">
                        <label for="inputZip" class="form-label grid-header">description</label>
                        <p>{!! $data->description ?? "n\a" !!}</p>
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
