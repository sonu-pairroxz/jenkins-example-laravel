@extends("admin.layouts.app")
@section('title', 'Laravel | Dashboard')
@push('styles')
    <style>
    </style>
@endpush
@section("content")

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Details</h4>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-primary" href="{{route('admin.dashboard')}}">Back</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <dic class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="inputZip" class="form-label">Rulling Reference</label>
                        <p>{{ $data->ruling_reference ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Issuing Country</label>
                        <p>{{ $data->issuing_country ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Start Date of Validaity</label>
                        <p>{{ $data->start_date_of_validity ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">End Date of Validaity</label>
                        <p>{{ $data->end_date_of_validity ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Nomenclature Code</label>
                        <p>{{ $data->nomenclature_code ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Nomenclature Code 4 digit</label>
                        <p>{{ $data->short_nomenclature_code ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Language</label>
                        <p>{{ $data->language ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Place of issue</label>
                        <p>{{ $data->place_of_issue ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Date of issue</label>
                        <p>{{ $data->date_of_issue ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Name address</label>
                        <p>{{ $data->name_address ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">ECCN</label>
                        <p>{{ $data->eccn ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Image URL</label>
                        <p><img src="{{asset($data->image_url)}}" height="150" width="150" alt="image" /></p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Amazon Doc</label>
                        <p>{{ $data->amazon_doc ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Chapter Note</label>
                        <p>{{ $data->chapter_note ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Comments</label>
                        <p>{{ $data->comments ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Image</label>
                        <p><img src="{{asset($data->image)}}" height="150" width="150" alt="image" /></p>
                    </div>
                    <div class="col-md-12">
                        <label for="inputZip" class="form-label">Classification Justification</label>
                        <p>{{ $data->classification_justification ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-12">
                        <label for="inputZip" class="form-label">Keywords</label>
                        <p>{{ $data->keywords ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-12">
                        <label for="inputZip" class="form-label">Description of goods</label>
                        <p>{{ $data->description_0f_goods ?? "n\a"}}</p>
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
