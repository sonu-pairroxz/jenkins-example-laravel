@extends('admin.layouts.app')
@push('styles')

@endpush
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Profile</h4>

                <div class="page-title-right">

                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row mb-4">
        <div class="col-xl-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-center">
                        <div class="clearfix"></div>
                        <div>
                            <img src="{{asset('assets/images/avatar.jpg')}}" alt="{{$user->fullname}}" class="avatar-lg rounded-circle img-thumbnail">
                        </div>
                        <h5 class="mt-3 mb-1">{{$user->fullname}}</h5>
                        <p class="text-muted"></p>

                        <div class="mt-4">

                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="text-muted">
                        <div class="table-responsive mt-4">
                            <div>
                                <p class="mb-1">Name :</p>
                                <h5 class="font-size-16">{{$user->fullname}}</h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">Mobile :</p>
                                <h5 class="font-size-16">{{$user->mobile_no}}</h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">E-mail :</p>
                                <h5 class="font-size-16">{{$user->email}}</h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">Location :</p>
                                <h5 class="font-size-16">{{$user->address ?? ""}}</h5>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="card mb-0">
                <!-- Tab content -->
                <div class="tab-content p-4">
                    <div class="tab-pane active" id="about" role="tabpanel">
                        <div>
                            <div>
                                <h5 class="font-size-16 mb-4">Orders</h5>

                                <div class="table-responsive">
                                    <table class="table table-nowrap table-hover mb-0">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Invoice No</th>
                                            <th scope="col">Order Amount</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col" style="width: 120px;">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($orders as $index=>$order)
                                        <tr>
                                           <td>{{$index+1}}</td>
                                           <td>{{$order->invoice_no}}</td>
                                           <td>{{$order->currency.' '.$order->order_total}}</td>
                                           <td>{{\Carbon\Carbon::parse($order->created_at)->format('d F, Y')}}</td>
                                           <td>{{$order->status}}</td>
                                            <td><a href="{{route('order.show',$order->id)}}" class="btn btn-outline-success"><i class="fas fa-eye"></i></a></td>
                                        </tr>
                                        @empty
                                            <tr><td colspan="6">No Order Placed yet</td></tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                {!! $orders->links('vendor.pagination.bootstrap-4') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@push('scripts')

@endpush
