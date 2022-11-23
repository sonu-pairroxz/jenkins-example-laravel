<!doctype html>
<html lang="en" direction="RTL">
<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="RIS" name="description" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="">

    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    @stack('styles')


    <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</head>
<body class="sidebar-enable vertical-collpsed">
<!-- Begin page -->
<div id="layout-wrapper">
    <!-- ========== Header Start ========== -->
    @include("admin.partials.header")
    <!-- Header End -->
    <!-- ========== Left Sidebar Start ========== -->
    @include("admin.partials._left_side_bar")
    <!-- Left Sidebar End -->



    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                @yield("content")

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


        @include("admin.partials.footer")
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"></h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        </div>
      </div>
    </div>
  </div>

{{-- View PDF    --}}
<div class="modal fade" id="modalpdfviewer" tabindex="-1" role="dialog" aria-labelledby="modalpdfviewer" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalpdfviewerTitle"></h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        </div>
      </div>
    </div>
  </div>
<!-- JAVASCRIPT -->
<script>
    function showImageModal(image){
        console.log($(image).attr('data-id'));
        $image = "<img width='850px' src='"+$(image).attr('data-id') +"' />";
        $('#exampleModalCenter').find('.modal-body').html($image);
        $('#exampleModalCenter').modal('show');
    }
    function showPDF(pdf){
        console.log($(pdf).attr('data-id'));
        $pdf = "<iframe frame-ancestors='self' id='iframe' src='"+$(pdf).attr('data-id')+"' width='1100px' height=580px> </iframe>";
        $('#modalpdfviewer').find('.modal-body').html($pdf);
        $('#modalpdfviewer').modal('show');
    }
    </script>
    <script>
        $('#iframe').onload = function(){
        var that = $(this)[0];
        try{
                that.contentDocument;
        }
        catch(err){
            console.log(err);
        }
        }
    </script>

<!-- App js -->
@stack('scripts')
</body>
</html>
