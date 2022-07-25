@extends('admin.layouts.app')
@push('styles')
<link href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@endpush
@section('content')
	<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Edit User</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('user.index')}}">Users</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong></strong></h2>
                        </div>
                        @if(\Session::get('error'))
		                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
		                        {{ \Session::get('error') }}
		                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                        <span aria-hidden="true">×</span>
		                        </button>
		                    </div>
	                    @endif
                        <div class="body">
                        	{{ Form::open(array('route' => array('user.update',$user->id), 'method'=>'post','files' => true,'name'=>'user-form','id'=>'user-form')) }}
                            {{method_field('put')}}
                        	<div class="form-group form-float">
                        		{{Form::text('name', $user->name, ['class'=>'form-control', 'placeholder'=>'Enter Name'])}}
                                @if ($errors->has('name'))
                                    {{Form::label('name', $errors->first('name'), array('class' => 'error', 'id'=>'name-error'))}}
                                @endif
                        	</div>
                            <div class="form-group form-float">
                                {{Form::email('email', $user->email, ['class'=>'form-control', 'placeholder'=>'Enter Email'])}}
                                @if ($errors->has('email'))
                                    {{Form::label('email', $errors->first('email'), array('class' => 'error', 'id'=>'email-error'))}}
                                @endif
                            </div>

                            <div class="form-group form-float">
                                {{Form::password('password',['class'=>'form-control','placeholder'=>'Enter Password'])}}
                                @if ($errors->has('password'))
                                    {{Form::label('password', $errors->first('password'), array('class' => 'error', 'id'=>'password-error'))}}
                                @endif
                            </div>
<!--                             <div class="form-group form-float">
                            	{{Form::file('image',null,['class'=>'form-control'])}}
                            </div>
                            <div class="form-group form-float">
                                @if($user->image)
                                <img src="{{asset('storage/'.$user->image)}}" alt="{{$user->name}}" height="200" width="200">
                                @endif
                            </div> -->
                            {{Form::button('Submit',['class'=>'btn btn-raised btn-primary waves-effect','type'=>'submit'])}}
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')

<script src="{{asset('assets/plugins/momentjs/moment.js')}}"></script>
@endpush