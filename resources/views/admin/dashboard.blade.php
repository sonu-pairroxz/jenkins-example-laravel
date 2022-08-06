@extends("admin.layouts.app")
@section('title', 'Laravel | Dashboard')
@push('styles')
    <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
    </style>
@endpush
@section("content")

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Dashboard</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <form id="search-form" name="search-form">
                        <div class="form-group mb-4">
                            <label for="search">Search</label>
                            <input type="search" name="search" class="form-control search" placeholder="Search here" />
                        </div>
                        <div class="form-group mb-4">
                            <button type="submit" class="btn btn-sm btn-primary" name="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-4">
                            <div class="custom-file text-left">
                                <input type="file" name="file" class="custom-file-input" id="customFile">
                            </div>
                        </div>
                        <button class="btn btn-sm btn-primary">Import data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Latest Transaction</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive nowrap datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="latestorder">
                            <thead class="table-light">
                            <tr>
                                <th>S No</th>
                                <th>Image</th>
                                <th>Ruling Reference</th>
                                <th>Issuing Country</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Nomenclature Code</th>
                                <th>Short Nomenclature Code</th>
                                <th>Short description</th>
                                <th>Chapter Note</th>
                                <th>Amazon Doc</th>
                                <th>Comments</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="modal" id="EditProductModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Comment</h4>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="alert-danger"></div>
                    <div id="EditProductModalBody">

                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="SubmitEditProductForm">Update</button>
                    <button type="button" class="btn btn-danger modelClose" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Product Modal -->
    <div class="modal" id="DeleteProductModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Product Delete</h4>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <h4>Are you sure want to delete this product?</h4>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="SubmitDeleteProductForm">Yes</button>
                    <button type="button" class="btn btn-default modelClose" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- apexcharts -->
    <script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>

    <script>
        var datatbleurl = "{{route('all-htus')}}";
        var table = {};
        $(function() {
            table = $('#latestorder').DataTable({
                processing: true,
                serverSide: true,
                bDestroy: true,
                scrollX: true,
                ajax: {
                    url: datatbleurl,
                    data: function (d) {
                        d.search = $('input[type="search"]').val()
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'ruling_reference',
                        name: 'ruling_reference'
                    },
                    {
                        data: 'issuing_country',
                        name: 'issuing_country'
                    },
                    {
                        data: 'start_date_of_validity',
                        name: 'start_date_of_validity'
                    },
                    {
                        data: 'end_date_of_validity',
                        name: 'end_date_of_validity'
                    },
                    {
                        data: 'nomenclature_code',
                        name: 'nomenclature_code'
                    },
                    {
                        data: 'short_nomenclature_code',
                        name: 'short_nomenclature_code'
                    },
                    {
                        data: 'short_description',
                        name: 'short_description'
                    },
                    {
                        data: 'chapter_note',
                        name: 'chapter_note'
                    },
                    {
                        data: 'amazon_doc',
                        name: 'amazon_doc'
                    },
                    {
                        data: 'comments',
                        name: 'comments'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            $('#search-form').on('submit', function(e) {
                table.draw();
                e.preventDefault();
            });
        });
    </script>

<script>
    $(document).ready(function() {
        $('.modelClose').on('click', function(){
            $('#EditProductModal').hide();
            $('#DeleteProductModal').hide();
        });

        var id;
        $('body').on('click', '#getEditProductData', function(e) {
            e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            id = $(this).data('id');
            $.ajax({
                url: "getItem/"+id,
                method: 'GET',
                // data: {
                //     id: id,
                // },
                success: function(result) {
                    console.log(result);
                    $('#EditProductModalBody').html(result.html);
                    $('#EditProductModal').show();
                }
            });
        });

        var deleteID;
        $('body').on('click', '#getDeleteId', function(){
            deleteID = $(this).data('id');
            $('#DeleteProductModal').show();
        })
        $('#SubmitDeleteProductForm').click(function(e) {
            e.preventDefault();
            var id = deleteID;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "deleteItem/"+id,
                method: 'DELETE',
                success: function(result) {
                    $('.datatable').DataTable().ajax.reload();
                    $('#DeleteProductModal').hide();
                }
            });
        });

        var itemID;
        $('body').on('click', '#getEditProductData', function(){
            itemID = $(this).data('id');
        })

        $('#SubmitEditProductForm').click(function(e) {
            e.preventDefault();
            var id = itemID;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $.ajax({
                url: "saveItem/"+id,
                method: 'POST',
                data: {
                    comments: $('#comments').val(),
                },
                success: function(result) {

                    if(result.status){
                        $('.datatable').DataTable().ajax.reload();
                        $('#EditProductModal').hide();
                    }else{
                        $(".alert-danger").html(result.message);
                    }
                }
            });
        });
    });
    </script>
@endpush
