@extends('acewebv.app')
{{-- @extends('layouts.member.app') --}}

@section('content')
    <script type="text/javascript">
        $(function() {
            // alert();
            // var info = getCookie("cart_items");
            // console.log("infos", JSON.parse(info) );
        });
    </script>
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="panel panel-info" style="margin-left: 15px;">
                <div class="panel-heading">
                    Login
                </div>
                <div class="panel-body">

                    @if (session()->has('success'))
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close"
                                        style="color: black !important;">×</a>
                                    {{ session()->get('success') }} Please Login.
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="alert alert-danger alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close"
                                        style="color: black !important;">×</a>
                                    {!! session()->get('error') !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    @php
                        if (request()->checkout == 1) {
                            $targetUrl = url('/') . '/checkout/';
                        } else {
                            $targetUrl = url()->previous();
                        }
                    @endphp

                    <form method="POST" action="{{ route('member.login-validate') }}">
                        @csrf

                        <input type="hidden" name="previous_uri" value="{{ $targetUrl }}" />
                        <input type="hidden" name="cart_items" id="cart_items" />
                        <input type="hidden" name="wish_item_ids" id="wish_item_ids" />

                        <div class="form-group row">
                            <label for="email"
                                class="col-sm-3 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                    value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div> --}}

                        <div class="form-group row">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <div class="col-md-6 col-md-offset-3">
                                <a href="{{ route('frontend.forgot-password') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div> --}}

                        {{-- <div class="form-group row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="col-md-3 offset-md-4">
                                <a class="btn btn-link" href="">
                                    By Phone
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a class="btn btn-link" href="">
                                    By E-Mail
                                </a>
                            </div>
                        </div>
                    </div> --}}

                        <div class="form-group row">
                            <div class="col-md-6 col-md-offset-3">
                                <button class="btn btn-link" id="register" style="cursor: ;">
                                    {{ __('Create a new account.') }}
                                </button>
                            </div>
                        </div>

                    </form>
                    <script type="text/javascript">
                        $(document).ready(function() {

                            var cart_items = localStorage.getItem("cart_items");
                            var wish_item_ids = localStorage.getItem("wish_item_ids");

                            $('#cart_items').val(cart_items);
                            $('#wish_item_ids').val(wish_item_ids);

                            $('#forgot').click(function(event) {
                                event.preventDefault();

                                // location.href = '{{ url('/') }}'+'/member/register';
                            });

                            $('#register').click(function(event) {
                                event.preventDefault();

                                location.href = '{{ url('/') }}' + '/member/register';
                            });


                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
