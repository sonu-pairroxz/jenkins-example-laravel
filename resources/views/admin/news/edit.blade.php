@extends('admin.layouts.app')
@push('styles')
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Edit News</h4>
                <div class="page-title-right">
                    <a href="{{route('news.index')}}" class="btn btn-sm btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
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
                    {{ Form::open(array('route' => ['news.update', $news->id], 'method'=>'post','files' => true,'name'=>'news-form','id'=>'news-form','class'=>'custom-validation')) }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                {{Form::text('title', $news->title, ['class'=>'form-control', 'placeholder'=>'Enter Title','required'=>'required','data-parsley-required-message'=>"Title is required"])}}
                                @error('title')
                                    {{Form::label('title', $message, array('class' => 'error', 'id'=>'title-error'))}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                {{Form::text('marketplace', $news->marketplace, ['class'=>'form-control', 'placeholder'=>'Enter marketplace','required'=>'required','data-parsley-required-message'=>"marketplace is required"])}}
                                @error('marketplace')
                                    {{Form::label('marketplace', $message, array('class' => 'error', 'id'=>'marketplace-error'))}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                <select class="form-control form-select" name="type" id="type" required="required" data-parsley-required-message="You must select at least one option">
                                    <option value="">Choose type</option>
                                    <option value="HS Tariff/ Landed cost change" {{$news->type == 'HS Tariff/ Landed cost change' ? 'selected' : ''}}>HS Tariff/ Landed cost change</option>
                                    <option value="World wide ruling update" {{$news->type == 'World wide ruling update' ? 'selected' : ''}}>World wide ruling update</option>
                                    <option value="Regulatory news" {{$news->type == 'Regulatory news' ? 'selected' : ''}}>Regulatory news</option>
                                    <option value="FTA News" {{$news->type == 'FTA News' ? 'selected' : ''}}>FTA News</option>
                                    <option value="WTO/WCO News" {{$news->type == 'WTO/WCO News' ? 'selected' : ''}}>WTO/WCO News</option>
                                    <option value="Other" {{$news->type == 'Other' ? 'selected' : ''}}>Other</option>
                                </select>
                                @error('type')
                                    {{Form::label('type', $message, array('class' => 'error', 'id'=>'type-error'))}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                {{-- {{Form::text('sim', $news->sim', ''), ['class'=>'form-control', 'placeholder'=>'Enter SIM', 'required'=>'required','data-parsley-required-message'=>"SIM is required"])}} --}}
                                <input type="date" name="date_of_publish" value="{{$news->date_of_publish}}" id="date_of_publish" class="form-control" required="required" data-parsley-required-message="Date of publish is required">
                                @error('sim')
                                    {{Form::label('date_of_publish', $message, array('class' => 'error', 'id'=>'date_of_publish-error'))}}
                                @enderror
                            </div>

                            <div class="mb-3">
                                {{-- {{Form::text('sim', $news->sim', ''), ['class'=>'form-control', 'placeholder'=>'Enter SIM', 'required'=>'required','data-parsley-required-message'=>"SIM is required"])}} --}}
                                <input type="date" name="date_of_change_applied" value="{{$news->date_of_change_applied}}" id="date_of_change_applied" class="form-control" required="required" data-parsley-required-message="Date of change applied is required">
                                @error('sim')
                                    {{Form::label('date_of_change_applied', $message, array('class' => 'error', 'id'=>'date_of_change_applied-error'))}}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                {{Form::textarea('description', $news->description, ['class'=>'form-control ckeditor', 'placeholder'=>'Enter description','rows' =>'6','required'=>'required'])}}
                                @error('description')
                                    {{Form::label('description', $message, array('class' => 'error', 'id'=>'description-error'))}}
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{Form::button('Submit',['class'=>'btn btn-primary waves-effect waves-light me-1','type'=>'submit'])}}
                    {{Form::button('Reset',['class'=>'btn btn-secondary waves-effect','type'=>'reset'])}}

                    {{Form::close()}}
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
@push('scripts')
<script src="{{asset('assets/libs/parsleyjs/parsley.min.js')}}"></script>
<script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
@endpush
