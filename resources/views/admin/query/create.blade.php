@extends('admin.layouts.app')
@push('styles')
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Ask a query</h4>
                <div class="page-title-right">
                    <a href="{{route('query.index')}}" class="btn btn-sm btn-primary">Back</a>
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
                    {{ Form::open(array('route' => 'query.store', 'method'=>'post','files' => true,'name'=>'query-form','id'=>'query-form','class'=>'custom-validation')) }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                {{Form::text('title', old('title', ''), ['class'=>'form-control', 'placeholder'=>'Enter Title','required'=>'required','data-parsley-required-message'=>"Title is required"])}}
                                @error('title')
                                    {{Form::label('title', $message, array('class' => 'error', 'id'=>'title-error'))}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                {{Form::text('asin', old('asin', ''), ['class'=>'form-control', 'placeholder'=>'Enter ASIN','required'=>'required','data-parsley-required-message'=>"ASIN is required"])}}
                                @error('asin')
                                    {{Form::label('asin', $message, array('class' => 'error', 'id'=>'asin-error'))}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                <select class="form-control form-select" name="work_stream" id="marketplace" required="required" data-parsley-required-message="You must select at least one option">
                                    <option value="">Choose work stream</option>
                                    <option value="DI" {{old('DI') ? 'selected' : ''}}>DI</option>
                                    <option value="Non DI" {{old('Non DI') ? 'selected' : ''}}>Non DI</option>
                                </select>
                                @error('work_stream')
                                    {{Form::label('work_stream', $message, array('class' => 'error', 'id'=>'work_stream-error'))}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                <select class="form-control form-select" name="marketplace" id="marketplace" required="required" data-parsley-required-message="Marketplace is required">
                                    <option value="">Choose Marketplace</option>
                                    <option value="GCC" {{old('GCC') ? 'selected' : ''}}>GCC</option>
                                    <option value="AU" {{old('AU') ? 'selected' : ''}}>AU</option>
                                    <option value="SG" {{old('SG') ? 'selected' : ''}}>SG</option>
                                    <option value="US" {{old('US') ? 'selected' : ''}}>US</option>
                                    <option value="CA" {{old('CA') ? 'selected' : ''}}>CA</option>
                                    <option value="MX" {{old('MX') ? 'selected' : ''}}>MX</option>
                                    <option value="BR" {{old('BR') ? 'selected' : ''}}>BR</option>
                                    <option value="EU" {{old('EU') ? 'selected' : ''}}>EU</option>
                                    <option value="IN" {{old('IN') ? 'selected' : ''}}>IN</option>
                                </select>
                                @error('marketplace')
                                    {{Form::label('marketplace', $message, array('class' => 'error', 'id'=>'marketplace-error'))}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                {{Form::text('tariff_node', old('tarrif_node', ''), ['class'=>'form-control', 'placeholder'=>'Enter Tariff Node', 'data-parsley-type'=>'number','required'=>'required','data-parsley-required-message'=>"Tariff Node is required"])}}
                                @error('tariff_node')
                                    {{Form::label('tariff_node', $message, array('class' => 'error', 'id'=>'tariff_node-error'))}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                {{Form::text('ruling_referred', old('ruling_referred', ''), ['class'=>'form-control', 'placeholder'=>'Enter Ruling Referred','required'=>'required','data-parsley-required-message'=>"Ruling Referred is required"])}}
                                @error('ruling_referred')
                                    {{Form::label('ruling_referred', $message, array('class' => 'error', 'id'=>'ruling_referred-error'))}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                {{Form::text('no_of_nfa_parked', old('no_of_nfa_parked', ''), ['class'=>'form-control', 'placeholder'=>'Enter No of NFA Parked', 'data-parsley-type'=>'number','required'=>'required','data-parsley-required-message'=>"No Of NFA Parked is required"])}}
                                @error('no_of_nfa_parked')
                                    {{Form::label('no_of_nfa_parked', $message, array('class' => 'error', 'id'=>'no_of_nfa_parked-error'))}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                {{Form::textarea('requester_comment', old('requester_comment', ''), ['class'=>'form-control', 'placeholder'=>'Enter Comment','rows' =>'6','required'=>'required'])}}
                                @error('requester_comment')
                                    {{Form::label('requester_comment', $message, array('class' => 'error', 'id'=>'requester_comment-error'))}}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                {{Form::textarea('description', old('description', ''), ['class'=>'form-control', 'placeholder'=>'Enter Description','rows' =>'6','required'=>'required'])}}
                                @error('description')
                                    {{Form::label('description', $message, array('class' => 'error', 'id'=>'description-error'))}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                <select class="form-control form-select" name="manager_id" id="manager_id" required="required" data-parsley-required-message="Manager  is required">
                                    <option value="">Choose Manager</option>
                                    <option value="arvags" {{old('arvags') ? 'selected' : ''}}>arvags</option>
                                    <option value="ckkohad" {{old('ckkohad') ? 'selected' : ''}}>ckkohad</option>
                                    <option value="mphadke" {{old('mphadke') ? 'selected' : ''}}>mphadke</option>
                                    <option value="smisaha" {{old('smisaha') ? 'selected' : ''}}>smisaha</option>
                                    <option value="parikhtp" {{old('parikhtp') ? 'selected' : ''}}>parikhtp</option>
                                </select>
                                @error('manager_id')
                                    {{Form::label('manager_id', $message, array('class' => 'error', 'id'=>'manager_id-error'))}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                {{Form::text('external_links', old('external_links', ''), ['class'=>'form-control', 'placeholder'=>'Enter External Links','required'=>'required','data-parsley-required-message'=>"External Link is required"])}}
                                @error('external_links')
                                    {{Form::label('external_links', $message, array('class' => 'error', 'id'=>'external_links-error'))}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                {{Form::text('document_referred', old('document_referred', ''), ['class'=>'form-control', 'placeholder'=>'Enter Document Referred','required'=>'required','data-parsley-required-message'=>"Document Referred is required"])}}
                                @error('document_referred')
                                    {{Form::label('document_referred', $message, array('class' => 'error', 'id'=>'document_referred-error'))}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                {{Form::text('itk', old('itk', ''), ['class'=>'form-control', 'placeholder'=>'Enter ITK','required'=>'required','data-parsley-required-message'=>"ITK is required"])}}
                                @error('itk')
                                    {{Form::label('itk', $message, array('class' => 'error', 'id'=>'itk-error'))}}
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
@endpush
