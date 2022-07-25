@extends('layouts.app')
@section('content')
<section>

    <!-- Register html -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-5 mb-5">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="loginForm">
                            <h2>@lang("register.create_an_account")</h2>
                            <form action="{{ route('register') }}" method="POST">
                              @csrf
                                <input type="text" id="first_name" class="form-control" placeholder="@lang('register.first_name')" value="{{old('first_name')}}" name="first_name" maxlength="20" required autofocus>
                                @if ($errors->has('first_name'))
                                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                @endif
                                <input type="text" id="first_name" class="form-control" placeholder="@lang('register.last_name')" value="{{old('last_name')}}" name="last_name" maxlength="20" required autofocus>
                                @if ($errors->has('last_name'))
                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                @endif
                                <input type="text" id="email_address" class="form-control" value="{{old('email')}}" placeholder="@lang('login.email')" name="email" maxlength="50" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                                <input type="number" id="mobile_no" class="form-control" value="{{old('mobile_no')}}" placeholder="@lang('login.mobile_no')" name="mobile_no" required>
                                @if ($errors->has('mobile_no'))
                                    <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                                @endif
                                <input type="password" id="password" class="form-control password-field1" placeholder="@lang('login.password')" name="password" required>
                                <span toggle=".password-field1" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                                <input type="password" id="password_confirmation" class="form-control cpassword-field" placeholder="@lang('login.confirm_password')" name="password_confirmation" required>
                                <span toggle=".cpassword-field" class="fa fa-fw fa-eye field-icon ctoggle-password"></span>
                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                                <button class="btn1" type="submit">@lang("register.create_an_account")</button>
                                <div class="newsLetter">
                                    <input type="checkbox" name="is_newsletter" id="is_newsletter">
                                    <span>@lang("register.newsletter")</span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="bgBox">
                            <h2>@lang("register.if_already_have_account")</h2>
                            <p>@lang("register.already_text")</p>
                            <a href="{{route('login')}}" class="btn3">@lang("login.login")</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Register html -->
</section>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
        $(".ctoggle-password").click(function() {
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
