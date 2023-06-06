@extends("admin.layouts.app")
@section('title', 'Laravel | Dashboard')
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
                        <p>@if(!empty($data->image_url))
                            @php $image_urls = explode(',', $data->image_url); @endphp
                            @if(is_array($image_urls) && !empty($image_urls))
                                @foreach($image_urls as $image)
                                <a href="{{$image}}" target='_blank'><img src="{{$image}}" height="150" width="150" alt="image" /></a>
                                @endforeach
                            @endif
                        @endif</p>
                        <p></p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Supporting Doc</label>
                        <p>@if(!empty($data->amazon_doc))
                            @php $amazon_docs = explode(',', $data->amazon_doc); @endphp
                            @if(is_array($amazon_docs) && !empty($amazon_docs))
                                @foreach($amazon_docs as $cn)
                                    <a href="{{$cn}}" target='_blank'><i class='uil-invoice'></i></a>
                                @endforeach
                            @endif
                        @endif</p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">SN/CN/EN/Leagal doc</label>
                        <p>
                            @if(!empty($data->chapter_note))
                            @php $chapter_notes = explode(',', $data->chapter_note); @endphp
                            @if(is_array($chapter_notes) && !empty($chapter_notes))
                                @foreach($chapter_notes as $cn)
                                    <a href="{{$cn}}" target='_blank'><i class='uil-invoice'></i></a>
                                @endforeach
                            @endif
                        @endif
                        </p>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Comments</label>
                        <p>{{ $data->comments ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-12 page">
                        <label for="inputZip" class="form-label grid-header">Classification Justification</label>
                        <p>{{ $data->classification_justification ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-12 page">
                        <label for="inputZip" class="form-label grid-header">Keywords</label>
                        <p>{{ $data->keywords ?? "n\a"}}</p>
                    </div>
                    <div class="col-md-12 page">
                        <label for="inputZip" class="form-label grid-header">Description of goods</label>
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
