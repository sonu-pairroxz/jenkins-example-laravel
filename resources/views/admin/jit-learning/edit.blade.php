@extends('admin.layouts.app')
@push('styles')
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Quiz/JIT Learning</h4>
                <div class="page-title-right">
                    <a href="{{route('jit-learning.index')}}" class="btn btn-sm btn-primary">Back</a>
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
                    {{ Form::open(array('route' => ['jit-learning.update', $jitlearning->id], 'method'=>'post','files' => true,'name'=>'jit-learning-form','id'=>'jit-learning-form','class'=>'custom-validation')) }}
                    <div class="row">
                        <h4>Ticket ID:- <strong>{{$jitlearning->ticket_id}}</strong></h4>
                        <div class="col-md-6">
                            <div class="mb-3">
                                {{Form::text('product_name', $jitlearning->product_name, ['class'=>'form-control', 'placeholder'=>'Enter Product name','required'=>'required','data-parsley-required-message'=>"Product name is required"])}}
                                @error('product_name')
                                    {{Form::label('product_name', $message, array('class' => 'error', 'id'=>'product_name-error'))}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                {{Form::text('asin', $jitlearning->asin, ['class'=>'form-control', 'placeholder'=>'Enter ASIN','required'=>'required','data-parsley-required-message'=>"ASIN is required"])}}
                                @error('asin')
                                    {{Form::label('asin', $message, array('class' => 'error', 'id'=>'asin-error'))}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                {{Form::textarea('keywords', $jitlearning->keywords, ['class'=>'form-control', 'placeholder'=>'Enter keywords','rows' =>'6','required'=>'required'])}}
                                @error('keywords')
                                    {{Form::label('keywords', $message, array('class' => 'error', 'id'=>'keywords-error'))}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                {{Form::text('error_type', $jitlearning->error_type, ['class'=>'form-control', 'placeholder'=>'Enter Error type','required'=>'required','data-parsley-required-message'=>"Error type is required"])}}
                                @error('error_type')
                                    {{Form::label('error_type', $message, array('class' => 'error', 'id'=>'error_type-error'))}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                {{Form::text('sim', $jitlearning->sim, ['class'=>'form-control', 'placeholder'=>'Enter SIM', 'required'=>'required','data-parsley-required-message'=>"SIM is required"])}}
                                @error('sim')
                                    {{Form::label('sim', $message, array('class' => 'error', 'id'=>'sim-error'))}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                {{Form::text('node', $jitlearning->node, ['class'=>'form-control', 'placeholder'=>'Node','required'=>'required','data-parsley-required-message'=>"Node is required"])}}
                                @error('node')
                                    {{Form::label('node', $message, array('class' => 'error', 'id'=>'node-error'))}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                {{Form::text('marketplace', $jitlearning->marketplace, ['class'=>'form-control', 'placeholder'=>'Enter Marketplace','required'=>'required','data-parsley-required-message'=>"Marketplace is required"])}}
                                @error('marketplace')
                                    {{Form::label('marketplace', $message, array('class' => 'error', 'id'=>'marketplace-error'))}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                {{Form::text('correct_code', $jitlearning->correct_code, ['class'=>'form-control', 'placeholder'=>'Enter Correct Code', 'data-parsley-type'=>'number','required'=>'required','data-parsley-required-message'=>"Correct Code is required"])}}
                                @error('correct_code')
                                    {{Form::label('correct_code', $message, array('class' => 'error', 'id'=>'correct_code-error'))}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                {{Form::text('incorrect_code', $jitlearning->incorrect_code, ['class'=>'form-control', 'placeholder'=>'Enter Incorrect Code', 'data-parsley-type'=>'number','required'=>'required','data-parsley-required-message'=>"Incorrect Code is required"])}}
                                @error('incorrect_code')
                                    {{Form::label('incorrect_code', $message, array('class' => 'error', 'id'=>'incorrect_code-error'))}}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                {{Form::textarea('learning', $jitlearning->learning, ['class'=>'form-control ckeditor', 'placeholder'=>'Enter Learning','rows' =>'6','required'=>'required'])}}
                                @error('learning')
                                    {{Form::label('learning', $message, array('class' => 'error', 'id'=>'learning-error'))}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                {{Form::textarea('correct_methodology', $jitlearning->correct_methodology, ['class'=>'form-control ckeditor', 'placeholder'=>'Enter Correct Methodology','rows' =>'6','required'=>'required'])}}
                                @error('correct_methodology')
                                    {{Form::label('correct_methodology', $message, array('class' => 'error', 'id'=>'correct_methodology-error'))}}
                                @enderror
                            </div>

                            <div class="mb-3">
                                {{Form::textarea('reference', $jitlearning->reference, ['class'=>'form-control ckeditor', 'placeholder'=>'Enter Reference','rows' =>'6','required'=>'required'])}}
                                @error('reference')
                                    {{Form::label('reference', $message, array('class' => 'error', 'id'=>'reference-error'))}}
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
