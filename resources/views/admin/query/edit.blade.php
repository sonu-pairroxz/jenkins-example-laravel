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
                            <h4>Ticket ID:- <strong>{{$query->ticket_id}}</strong></h4>
                            <div class="mb-3">
                                {{Form::label('title', '', array('class' => '', 'id'=>'title'))}}
                                {{Form::text('title', $query->title, ['class'=>'form-control','readonly'=>'readonly'])}}
                            </div>
                            <div class="mb-3">
                                {{Form::label('asin', 'ASIN', array('class' => '', 'id'=>'asin'))}}
                                {{Form::text('asin', $query->asin, ['class'=>'form-control', 'readonly'=>'readonly'])}}
                            </div>
                            <div class="mb-3">
                                {{Form::label('work_stream', 'Work Stream', array('class' => '', 'id'=>'work_stream'))}}
                                {{Form::text('work_stream', $query->work_stream, ['class'=>'form-control', 'readonly'=>'readonly'])}}
                            </div>
                            <div class="mb-3">
                                {{Form::label('tariff_node', 'Tariff Node', array('class' => '', 'id'=>'tariff_node'))}}
                                {{Form::text('tariff_node', $query->tariff_node, ['class'=>'form-control', 'readonly'=>'readonly'])}}
                            </div>
                            <div class="mb-3">
                                {{Form::label('ruling_referred', 'Ruling Referred', array('class' => '', 'id'=>'ruling_referred'))}}
                                {{Form::text('ruling_referred', $query->ruling_referred, ['class'=>'form-control', 'readonly'=>'readonly'])}}
                            </div>
                            <div class="mb-3">
                                {{Form::label('no_of_nfa_parked', 'No of NFA Parked', array('class' => '', 'id'=>'no_of_nfa_parked'))}}
                                {{Form::text('no_of_nfa_parked', $query->no_of_nfa_parked, ['class'=>'form-control','readonly'=>'readonly'])}}
                            </div>
                            <div class="mb-3">
                                {{Form::label('requester_comment', null, array('class' => '', 'id'=>'requester_comment'))}}
                                {{Form::textarea('requester_comment', $query->requester_comment ?? "", ['class'=>'form-control', 'readonly'=>'readonly','rows' =>'6'])}}

                            </div>
                            <div class="mb-3">
                                {{Form::label('image_url', 'Image URL', array('class' => '', 'id'=>'image_url'))}}
                                <img src="{{$query->image_url}}" height=100 width=100>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                {{Form::label('description', null, array('class' => '', 'id'=>'description'))}}
                                {{Form::textarea('description', $query->description, ['class'=>'form-control', 'readonly'=>'readonly','rows' =>'6'])}}
                            </div>
                            <div class="mb-3">
                                {{Form::label('external_links', null, array('class' => '', 'id'=>'external_links'))}}
                                {{Form::text('external_links', $query->external_links, ['class'=>'form-control', 'readonly'=>'readonly'])}}
                            </div>
                            <div class="mb-3">
                                {{Form::label('document_referred', null, array('class' => '', 'id'=>'document_referred'))}}
                                {{Form::text('document_referred', $query->document_referred, ['class'=>'form-control', 'readonly'=>'readonly'])}}
                            </div>
                            <div class="mb-3">
                                {{Form::label('itk', "ITK", array('class' => '', 'id'=>'itk'))}}
                                {{Form::text('itk', $query->itk, ['class'=>'form-control', 'readonly'=>'readonly'])}}
                            </div>
                            <div class="mb-3">
                                {{Form::label('manager_id', "Manager", array('class' => '', 'id'=>'manager_id'))}}
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
                            <div class="mb-3">
                                {{Form::label('marketplace', 'Marketplace', array('class' => '', 'id'=>'marketplace'))}}
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

                            <div class="mb-3">
                                {{Form::label('resolver_comment', null, array('class' => '', 'id'=>'resolver_comment'))}}
                                {{Form::textarea('resolver_comment', old('resolver_comment', $query->resolver_comment ?? ""), ['class'=>'form-control', 'placeholder'=>'Add your comment','rows' =>'6'])}}
                                @error('resolver_comment')
                                    {{Form::label('resolver_comment', $message, array('class' => 'error', 'id'=>'resolver_comment-error'))}}
                                @enderror
                            </div>

                            <div class="mb-3">
                                {{Form::label('status', 'Status', array('class' => '', ))}}
                                <select class="form-control form-select" name="status" required="required" data-parsley-required-message="Status is required">
                                    <option value="">Choose Status</option>
                                    <option value="Pending" {{$query->status == 'Pending' ? 'selected' : ''}}>Pending</option>
                                    <option value="Resolved" {{$query->status == 'Resolved' ? 'selected' : ''}}>Resolved</option>
                                    <option value="Reopen" {{$query->status == 'Reopen' ? 'selected' : ''}}>Reopen</option>
                                </select>
                                @error('marketplace')
                                    {{Form::label('marketplace', $message, array('class' => 'error', 'id'=>'marketplace-error'))}}
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
