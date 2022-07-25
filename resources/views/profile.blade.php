@extends('layouts.app')
@push('styles')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
    @endpush
@section('content')
<section>
    <div class="innerBanner">
        <img src="{{asset('assets/images/inner-page-banner.jpg')}}" alt="profile">
        <div class="bannerText">
            <p><a href="{{url('/')}}">Home</a><i class="fa fa-angle-right"></i><span>Profile</span></p>
        </div>
    </div>
</section>
<section class="profilePage">
    <div class="container">
        <div class="row tabSec">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 sideMenu">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="{{route('profile')}}">Profile</a></li>
                    <li><a href="{{route('change-password')}}">Change Password</a></li>
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
                        <h3>{{auth()->user()->fullname}}</h3>
                        <p>{{auth()->user()->email}}</p>
                        <div class="loginForm profileform">
                            <form action="{{route('profile.update',auth()->user()->id)}}" method="POST">
                                @csrf
                                <input type="text" name="first_name" value="{{auth()->user()->first_name}}" maxlength="20" placeholder="First Name">
                                @if($errors->has('first_name'))
                                    <p style="color: red">{{$errors->first('first_name')}}</p>
                                @endif
                                <input type="text" name="last_name" value="{{auth()->user()->last_name}}" maxlength="20" placeholder="Last Name">
                                @if($errors->has('last_name'))
                                    <p style="color: red">{{$errors->first('last_name')}}</p>
                                @endif
                                <input type="email" name="email" value="{{auth()->user()->email}}" maxlength="50" placeholder="Email Address">
                                @if($errors->has('email'))
                                    <p style="color: red">{{$errors->first('email')}}</p>
                                @endif
                                <input type="number" placeholder="Mobile Number" name="mobile_no" value="{{auth()->user()->mobile_no}}">
                                @if($errors->has('mobile_no'))
                                    <p style="color: red">{{$errors->first('mobile_no')}}</p>
                                @endif
                                <button class="btn1" type="submit">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
