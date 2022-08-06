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
                    {{ Form::open(array('route' => ['query.update', $query->id], 'method'=>'post','files' => true,'name'=>'query-form','id'=>'query-form','class'=>'custom-validation')) }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <select class="form-control form-select" name="marketplace" id="marketplace" required="required" data-parsley-required-message="Marketplace is required">
                                    <option value="">Choose Marketplace</option>
                                    <option value="GCC" {{$query->marketplace == 'GCC' ? 'selected' : ''}}>GCC</option>
                                    <option value="AU" {{$query->marketplace == 'AU' ? 'selected' : ''}}>AU</option>
                                    <option value="SG" {{$query->marketplace == 'SG' ? 'selected' : ''}}>SG</option>
                                    <option value="US" {{$query->marketplace == 'US' ? 'selected' : ''}}>US</option>
                                    <option value="CA" {{$query->marketplace == 'CA' ? 'selected' : ''}}>CA</option>
                                    <option value="MX" {{$query->marketplace == 'MX' ? 'selected' : ''}}>MX</option>
                                    <option value="BR" {{$query->marketplace == 'BR' ? 'selected' : ''}}>BR</option>
                                    <option value="EU" {{$query->marketplace == 'EU' ? 'selected' : ''}}>EU</option>
                                    <option value="IN" {{$query->marketplace == 'IN'? 'selected' : ''}}>IN</option>
                                </select>
                                @error('marketplace')
                                    {{Form::label('marketplace', $message, array('class' => 'error', 'id'=>'marketplace-error'))}}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <select class="form-control form-select" name="manager_id" id="manager_id" required="required" data-parsley-required-message="Manager  is required">
                                    <option value="">Choose Manager</option>
                                    <option value="arvags" {{$query->manager_id == 'arvags' ? 'selected' : ''}}>arvags</option>
                                    <option value="ckkohad" {{$query->manager_id == 'ckkohad' ? 'selected' : ''}}>ckkohad</option>
                                    <option value="mphadke" {{$query->manager_id == 'mphadke' ? 'selected' : ''}}>mphadke</option>
                                    <option value="smisaha" {{$query->manager_id == 'smisaha' ? 'selected' : ''}}>smisaha</option>
                                    <option value="parikhtp" {{$query->manager_id == 'parikhtp' ? 'selected' : ''}}>parikhtp</option>
                                </select>
                                @error('manager_id')
                                    {{Form::label('manager_id', $message, array('class' => 'error', 'id'=>'manager_id-error'))}}
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{Form::button('Submit',['class'=>'btn btn-primary waves-effect waves-light me-1','type'=>'submit'])}}
                    <a href="{{route('query.index')}}" class="btn btn-secondary waves-effect">Cancel</a>

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
