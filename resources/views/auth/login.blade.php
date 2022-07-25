@extends('layouts.app')
@section('content')
<section>

    <!-- login html -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-5 mb-5">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="loginForm">
                            <h2>@lang('login.login')</h2>
                            <form action="{{ route('login') }}" method="POST">
                              @csrf
                              @if ($errors->has('email'))
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                              @endif
                                <input type="text" id="email_address" class="form-control" value="{{old('email')}}" placeholder="@lang('login.email')" name="email" required autofocus>

                                <input type="password" id="password" class="form-control" placeholder="@lang('login.password')" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                                <button class="btn1" type="submit">@lang('login.login')</button>
                                {{--<a class="btn2">Forgot Your Password?</a>--}}
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="bgBox">
                            <h2>@lang("login.do_not_have_account")</h2>
                            <p>@lang("login.do_not_have_account_text")</p>
                            <a href="{{route('register')}}" class="btn3">@lang("register.create_an_account")</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End login html -->
</section>
@endsection
