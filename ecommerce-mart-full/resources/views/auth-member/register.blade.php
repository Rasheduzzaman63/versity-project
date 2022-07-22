@extends('acewebv.app')
{{-- @extends('layouts.member.app') --}}

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="panel panel-info" style="margin-left: 15px;">
                <div class="panel-heading">{{ __('Register') }}</div>
                <div class="panel-body">

                    @php
                        if (request()->checkout == 1) {
                            $targetUrl = url('/') . '/checkout/';
                        } else {
                            $targetUrl = url()->previous();
                        }
                    @endphp

                    <form method="POST" action="{{ route('member.register') }}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="previous_uri" value="{{ $targetUrl }}" />
                        <input type="hidden" name="cart_items" id="cart_items" />
                        <input type="hidden" name="wish_item_ids" id="wish_item_ids" />

                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                    value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-3 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text"
                                    class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone"
                                    value="{{ old('phone') }}" required autofocus>

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-3 col-form-label text-md-right">{{ __('Image') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="file"
                                    class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image"
                                    required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email"
                                class="col-md-3 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                    value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address"
                                class="col-md-3 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <textarea id="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address"
                                    value="{{ old('address') }}" required autofocus></textarea>

                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
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

                        <div class="form-group row">
                            <label for="password-confirm"
                                class="col-md-3 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 col-md-offset-3">
                                <button class="btn btn-link" id="login-link" style="cursor: ;">
                                    {{ __('Already registered? Please login.') }}
                                </button>
                            </div>
                        </div>

                    </form>

                    <script type="text/javascript">
                        $(document).ready(function() {

                            $('#login-link').click(function(event) {
                                event.preventDefault();

                                location.href = '{{ url('/') }}' + '/member/login';
                            });

                            var cart_items = localStorage.getItem("cart_items");
                            var wish_item_ids = localStorage.getItem("wish_item_ids");

                            $('#cart_items').val(cart_items);
                            $('#wish_item_ids').val(wish_item_ids);

                            $('#forgot').click(function(event) {
                                event.preventDefault();

                                // location.href = '{{ url('/') }}'+'/member/register';
                            });

                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
