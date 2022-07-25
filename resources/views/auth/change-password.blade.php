@extends('layouts.app')
@push('styles')
    <style>

    </style>

@endpush
@section('content')
    <section>
        <div class="innerBanner">
            <img src="{{asset('assets/images/inner-page-banner.jpg')}}" alt="profile">
            <div class="bannerText">
                <p><a href="{{url('/')}}">Home</a><i class="fa fa-angle-right"></i><span>Change Password</span></p>
            </div>
        </div>
    </section>
    <section class="profilePage">
        <div class="container">
            <div class="row tabSec">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 sideMenu">
                    <ul class="nav nav-tabs">
                        <li><a href="{{route('profile')}}">Profile</a></li>
                        <li class="active"><a href="javascript:void(0);">Change Password</a></li>
                        <li><a href="{{route('orders.index')}}">My Order</a></li>
                        <li><a href="{{route('wishlist.index')}}">Wishlist</a></li>
                        <li><a href="{{route('logout')}}">Logout</a></li>
                    </ul>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="tab-content">
                        @if(session()->has('error'))
                            <p>{{session()->get('error')}}</p>
                        @endif
                        @if(session()->has('success'))
                            <p>{{session()->get('success')}}</p>
                        @endif
                        <div id="menu" class="tab-pane active">
                            <div class="loginForm profileform">
                                <h3>Change Password</h3>
                                <form action="{{route('update-password')}}" method="POST">
                                    @csrf
                                    <div class="password-field">
                                        <input type="password" class="opassword-field" name="old_password" placeholder="Old Password">
                                        <span toggle=".opassword-field" class="fa fa-fw fa-eye field-icon toggle-opassword tg"></span>
                                        @if($errors->has('old_password'))
                                            <p style="color: red">{{$errors->first('old_password')}}</p>
                                        @endif
                                    </div>
                                   <div class="password-field">
                                       <input type="password" name="new_password" class="npassword-field" placeholder="New Password">
                                       <span toggle=".npassword-field" class="fa fa-fw fa-eye field-icon toggle-npassword tg"></span>
                                       @if($errors->has('new_password'))
                                           <p style="color: red">{{$errors->first('new_password')}}</p>
                                       @endif
                                   </div>
                                    <div class="password-field">
                                        <input type="password" name="confirm_password" class="cpassword-field" placeholder="Confirm Password">
                                        <span toggle=".cpassword-field" class="fa fa-fw fa-eye field-icon toggle-cpassword tg"></span>
                                        @if($errors->has('confirm_password'))
                                            <p style="color: red">{{$errors->first('confirm_password')}}</p>
                                        @endif
                                    </div>
                                    <button class="btn1" type="submit">Update Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(".toggle-opassword").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
        $(".toggle-npassword").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
        $(".toggle-cpassword").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
@endpush
