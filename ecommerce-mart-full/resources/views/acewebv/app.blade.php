<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('head_title') {{ config('app_settings.application_title') }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('/') }}/images/ecommerce-icon.png">
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/frontend2/css/normalize.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/frontend2/css/main.css">
    <link rel="stylesheet" href="{{ url('/') }}/frontend2/css/custom.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/frontend2/css/bootstrap.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/frontend2/css/animate.min.css">
    <!-- Font-awesome CSS-->
    {{-- <link rel="stylesheet" href="{{url('/')}}/frontend2/css/font-awesome.min.css"> --}}
    <link rel="stylesheet" href="{{ url('/') }}/ace_assets/css/font-awesome.css" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    {{-- to match with old v4 --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/v4-shims.css">
    <!-- Owl Caousel CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/frontend2/vendor/OwlCarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/frontend2/vendor/OwlCarousel/owl.theme.default.min.css">
    <!-- Main Menu CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/frontend2/css/meanmenu.min.css">
    <!-- nivo slider CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/frontend2/vendor/slider/css/nivo-slider.css" type="text/css" />
    <link rel="stylesheet" href="{{ url('/') }}/frontend2/vendor/slider/css/preview.css" type="text/css"
        media="screen" />
    <!-- Datetime Picker Style CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/frontend2/css/jquery.datetimepicker.css">
    <!-- Magic popup CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/frontend2/css/magnific-popup.css">
    <!-- Switch Style CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/frontend2/css/hover-min.css">
    <!-- ReImageGrid CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/frontend2/css/reImageGrid.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/frontend2/css/style.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/fileinput.min.css">
    <!-- Modernizr Js -->
    <script src="{{ url('/') }}/frontend2/js/modernizr-2.8.3.min.js"></script>
    <script src="{{ url('/') }}/frontend2/js/jquery-2.2.4.min.js" type="text/javascript"></script>

    <!-- Google Map js -->
    {{-- use iframe instead --}}
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtmXSwv4YmAKtcZyyad9W7D4AC08z0Rb4"></script> --}}

    <script src="{{ url('/') }}/frontend2/js/notify/notify.min.js"></script>
    <script src="{{ url('/') }}/js/fileinput.min.js"></script>

    <style>
        nav#desktop-nav ul li .mega-menu-area>li {
            width: 230px;
            border-bottom: none;
            display: inline-block;
            margin-right: 14px;
        }

        nav#desktop-nav li.has-child-menu>ul.thired-level {
            left: 340px;
        }

        nav#desktop-nav ul li>ul {
            width: 340px;
        }

        .footer-box img {
            width: 210px;
            height: 195px;
        }

        .carousel-inner>.item>img {
            height: 490px;
        }

        .news-img-holder img {
            height: auto;
        }

        .owl-carousel .owl-item img {
            display: block;
            width: 100%;
            -webkit-transform-style: preserve-3d;
            /*height: 200px;*/
        }

        .header-top-right,
        .header-top-left {
            font-weight: bold;
        }

        .main-menu-area .header-search .search-form {
            background: rgba(0, 0, 0, 0.8);
            border: 2px solid #002147;
        }

        .search-result {
            text-align: left;
            position: absolute;
            bottom: -128px;
            right: 15px;
            z-index: 10;
            color: #eee;
            /*height: 50px;*/
            width: 500px;
            font-size: 18px;
            background: rgba(0, 0, 0, 0.7);
            border: 2px solid #000000;
            /*padding: 5px 18px 5px 10px;*/
            -webkit-box-shadow: inset 0px 0px 10px 5px rgba(253, 200, 0, 0.3);
            -moz-box-shadow: inset 0px 0px 10px 5px rgba(253, 200, 0, 0.3);
            box-shadow: inset 0px 0px 10px 5px rgba(253, 200, 0, 0.3);
        }

        .search-result li {
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 15px;
            border: 1px solid #ccc;
        }

        .lecturers-content-wrapper .item-title {
            font-size: 14px;
        }

        .search-img {
            height: 50px;
            width: 70px;
        }

        nav#desktop-nav ul li>ul>li>a {
            padding: 5px 10px 5px 15px;
            font-size: 12px;
        }

        .footer-area-top {
            padding: 40px 0 0px;
        }

        @media screen and (min-width: 481px) {
            #search-button___2 {
                display: none;
            }

            #search-close {
                display: none;
            }
        }

        @media screen and (max-width: 480px) {
            #search-button___2 {
                display: block;
            }

            #slide-wrapper {
                margin-top: 7%;
            }
        }

        .mean-nav {
            margin-top: 17px;
        }

        .footer-area-top .featured-links>li ul li::before {
            display: none;
        }
    </style>
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("errorThrown", errorThrown);
                    console.log("textStatus", textStatus);
                    console.log("jqXHR", jqXHR);
                    if (jqXHR.status == 419) {
                        $.notify('Session Expired! Refreshing...', 'error');
                        setTimeout(function() {

                            location.reload();
                        }, 1000);
                    }
                    if (jqXHR.status == 401) {
                        $.notify('Unauthenticated! Refreshing...', 'error');
                        setTimeout(function() {

                            location.reload();
                        }, 1000);
                    }

                }
            });

        });
    </script>
    <style type="text/css">
        .card-product:after {
            content: "";
            display: table;
            clear: both;
            visibility: hidden;
        }

        .card-product .price-new,
        .card-product .price {
            margin-right: 5px;
        }

        .card-product .price-old {
            color: #999;
        }

        .card-product .img-wrap {
            border-radius: 3px 3px 0 0;
            overflow: hidden;
            position: relative;
            height: 220px;
            text-align: center;
        }

        .card-product .img-wrap img {
            height: 100%;
            width: 100%;
            /*object-fit: cover;*/
        }

        .card-product .info-wrap {
            overflow: hidden;
            padding: 15px;
            border-top: 1px solid #eee;
        }

        .card-product .action-wrap {
            padding-top: 4px;
            margin-top: 4px;
        }

        .card-product .bottom-wrap {
            padding: 15px;
            border-top: 1px solid #eee;
        }

        .card-product .title {
            margin-top: 0;
        }

        .float-right {
            float: right;
        }
    </style>
    <style>
        .mini-submenu {
            display: none;
            background-color: rgba(0, 0, 0, 0);
            border: 1px solid rgba(0, 0, 0, 0.9);
            border-radius: 4px;
            padding: 9px;
            /*position: relative;*/
            width: 42px;

        }

        .mini-submenu:hover {
            cursor: pointer;
        }

        .mini-submenu .icon-bar {
            border-radius: 1px;
            display: block;
            height: 2px;
            width: 22px;
            margin-top: 3px;
        }

        .mini-submenu .icon-bar {
            background-color: #000;
        }

        #slide-submenu {
            background: rgba(0, 0, 0, 0.45);
            display: inline-block;
            padding: 0 8px;
            border-radius: 4px;
            cursor: pointer;
        }

        .list-group-item {
            line-height: 1;
            padding: 8px 15px;
        }

        .table>tbody>tr>td,
        .table>tbody>tr>th,
        .table>tfoot>tr>td,
        .table>tfoot>tr>th,
        .table>thead>tr>td,
        .table>thead>tr>th {
            vertical-align: middle;
        }

        a.list-group-item,
        button.list-group-item {
            font-weight: bold;
        }

        .text-dots {
            min-height: 110px;
        }
        
        .card-product{

            background: #f4fdf9;
            margin-bottom: 15px;
        }
    </style>
</head>

<?php

$auth_user = session('member_data');
?>

<body>
    <div id="wrapper">
        <!-- Header Area Start Here -->
        <header>
            <div id="header2" class="header2-area">
                <div class="header-top-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="header-top-left">
                                    <ul>
                                        <li><i class="fa fa-phone" aria-hidden="true"></i><a href="Tel:+1234567890">
                                                {{ config('app_settings.site_phone') }} </a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="header-top-right">
                                    <ul>
                                        {{-- <li>
                                            <a class="login-btn-area" href="#" id="login-button"><i
                                                    class="fa fa-envelope-o" aria-hidden="true"></i>
                                                {{ config('app_settings.site_email') }}</a>
                                        </li> --}}
                                        @if (!$auth_user)
                                            <li>
                                                <a class="login-btn-area" href="#"
                                                    onclick="event.preventDefault(); document.getElementById('login-btn').click();"
                                                    id="login-button"><i class="fa fa-lock" aria-hidden="true"></i>
                                                    Login</a>
                                            </li>
                                        @else
                                            <li>

                                                <a class="login-btn-area" href="{{ url('member/profile') }}">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    {{ $auth_user->name }}
                                                </a>
                                            </li>

                                            <li>
                                                <a class="login-btn-area" href="{{ route('member.logout') }}"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                                        class="fa fa-power-off" aria-hidden="true"></i>
                                                    Logout</a>
                                            </li>
                                        @endif
                                    </ul>
                                    <a hidden id="login-btn" href="{{ route('member.login') }}">Login..</a>
                                    <form id="logout-form" action="{{ route('member.logout') }}" method="POST"
                                        style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-menu-area bg-textPrimary" id="sticker">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-1">
                                <div class="logo-area">
                                    {{-- <a href="{{url('/')}}"><img class="img-responsive" src="{{ ( config('app_settings.site_logo') ) }}" alt="logo"></a> --}}
                                    <a href="{{ url('/') }}"><img class="img-responsive"
                                            src="{{ url('images/ecommerce-logo.jpg') }}" alt="logo"></a>
                                </div>
                            </div>

                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <nav id="desktop-nav">
                                    <ul>
                                        <li class="active-"><a href="{{ url('/') }}">Home</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('my/about') }}">About Us</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('my/contact') }}">Contact</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('my/cart/product/view') }}">My Cart</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('my/order/view') }}">My Orders</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="col-lg-1 col-md-1 hidden-sm">
                                <div class="header-search">
                                    <a href="#" class="search-button___" id="search-button___"
                                        data-toggle="modal" data-target="#exampleModal"><i class="fa fa-search"
                                            aria-hidden="true"></i></a>

                                    <form action="{{ url('movies/?') }}" method="get" class="search-form-main"
                                        style="display: none;">
                                        <input type="text" class="search-form" id="live-search" name="search"
                                            placeholder="Search...." required="">

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu Area Start -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul>
                                        <li class="active-"><a href="{{ url('/') }}">Home</a>
                                        </li>

                                        <li>
                                            <a href="{{ url('my/about') }}">About Us</a>
                                        </li>

                                        <li>
                                            <a href="{{ url('my/contact') }}">Contact</a>
                                        </li>

                                        <li>
                                            <a href="{{ url('my/cart/product/view') }}">My Cart</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('my/order/view') }}">My Orders</a>
                                        </li>

                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu Area End -->
        </header>
        <!-- Header Area End Here -->

        <a href="#" style="float: right;right: 7%;position: absolute;" class="search-button___"
            id="search-button___2" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-search"
                aria-hidden="true"></i></a>

        @include('layouts.notification')

        <div class="container">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        @php
                            $categories = App\Models\Category::all();
                            $sliders = App\Models\Slider::latest()->get();
                        @endphp

                        <div class="col-sm-4 col-md-3 sidebar">
                            <div class="mini-submenu">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </div>
                            <div class="list-group">
                                <span href="#" class="list-group-item active">
                                    Categories
                                    <span class="pull-right" id="slide-submenu">
                                        <i class="fa fa-times"></i>
                                    </span>
                                </span>

                                @foreach ($categories as $key => $value)
                                    <a href="{{ route('category.menu', $value->id) }}" class="list-group-item">
                                        {{-- <i class="fa fa-folder-open-o"></i> --}}
                                        {{ $value->name }}
                                    </a>
                                @endforeach


                            </div>
                        </div>
                        <div class="col-md-9">

                            @if (request()->is('/'))

                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                        <li data-target="#myCarousel" data-slide-to="1"></li>
                                        <li data-target="#myCarousel" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner" role="listbox">

                                        @foreach ($sliders as $slider)
                                            <div class="item {{ $loop->index == 0 ? 'active' : '' }} ">
                                                <img class="first-slide" src="{{ url($slider->slider_image) }}"
                                                    alt="slide" style="height: 260px !important;">
                                                <div class="container">
                                                    <div class="carousel-caption" style="display: none;">
                                                        <h3>{{ $slider->title }}</h3>
                                                        <p>{{ $slider->description }}</p>
                                                        <p><a class="btn btn-lg btn-primary"
                                                                href="{{ $slider->link }}" role="button"> Go
                                                            </a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                    <a class="left carousel-control" href="#myCarousel" role="button"
                                        data-slide="prev">
                                        <span class="fa fa-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#myCarousel" role="button"
                                        data-slide="next">
                                        <span class="fa fa-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div><!-- /.carousel -->
                            @else
                                <div class=" justify-content-center"
                                    style="display: flex;  justify-content: space-between;">
                                    <div class="col-md-12 mb-2" style="margin-bottom: 5px">
                                        <img class="img-responsive" src="{{ url('/images/ecommerce-banner.jpg') }}"
                                            style="height: 260px; width: 100%;">
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="row">

                        <div class="col-sm-4 col-md-3">
                        </div>

                        <div class="col-sm-9">

                            @yield('content')

                        </div>
                    </div>
                </div>


            </section>
        </div>

        <footer>
            <div class="footer-area-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="footer-box">
                                <h3>Social Links</h3>
                                <h4>
                                    <strong>
                                        <a href="" class="text-default"
                                            style="color: white;">{{ config('app_settings.application_title') }}</a>
                                    </strong>
                                </h4>
                                <p>{{ config('app_settings.site_slogan') }}</p>
                                <ul class="footer-social">
                                    <li><a target="_blank" href="{{ config('app_settings.facebook_link') }}"><i
                                                class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a target="_blank" href="{{ config('app_settings.twitter_link') }}"><i
                                                class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a target="_blank" href="{{ config('app_settings.youtube_link') }}"><i
                                                class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                    <li><a target="_blank" href="{{ config('app_settings.instagram_link') }}"><i
                                                class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                    <li><a target="_blank" href="{{ config('app_settings.linkedin_link') }}"><i
                                                class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="footer-box">
                                <h3>Features </h3>
                                <ul class="featured-links">
                                    <li>
                                        <ul>
                                            @if (strlen(config('app_settings.important_link_1')) > 0)
                                                <li><a target=""
                                                        href="{{ config('app_settings.important_link_1') }}">{{ config('app_settings.important_link_1_name') }}</a>
                                                </li>
                                            @endif

                                            @if (strlen(config('app_settings.important_link_2')) > 0)
                                                <li><a target=""
                                                        href="{{ config('app_settings.important_link_2') }}">{{ config('app_settings.important_link_2_name') }}</a>
                                                </li>
                                            @endif

                                            @if (strlen(config('app_settings.important_link_3')) > 0)
                                                <li><a target=""
                                                        href="{{ config('app_settings.important_link_3') }}">{{ config('app_settings.important_link_3_name') }}</a>
                                                </li>
                                            @endif

                                            @if (strlen(config('app_settings.important_link_4')) > 0)
                                                <li><a target=""
                                                        href="{{ config('app_settings.important_link_4') }}">{{ config('app_settings.important_link_4_name') }}</a>
                                                </li>
                                            @endif

                                            @if (strlen(config('app_settings.important_link_5')) > 0)
                                                <li><a target=""
                                                        href="{{ config('app_settings.important_link_5') }}">{{ config('app_settings.important_link_5_name') }}</a>
                                                </li>
                                            @endif

                                            @if (strlen(config('app_settings.important_link_6')) > 0)
                                                <li><a target=""
                                                        href="{{ config('app_settings.important_link_6') }}">{{ config('app_settings.important_link_6_name') }}</a>
                                                </li>
                                            @endif

                                        </ul>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="footer-box">
                                <h3>Information</h3>
                                <ul class="corporate-address">
                                    <li>
                                        <i class="fa fa-home" aria-hidden="true"></i>
                                        {{ config('app_settings.site_address') }}
                                    </li>
                                    <li>
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        <a
                                            href="Tel:{{ config('app_settings.site_phone') }}">{{ config('app_settings.site_phone') }}</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-envelope-o"></i>
                                        {{ config('app_settings.site_email') }}
                                    </li>
                                </ul>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="footer-area-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <p class="text-center">&copy; {{ date('Y') }} All Rights Reserved.
                                {{ config('app_settings.application_title') }}.
                                Developed By: Sarwar Hossain, Md Rasheduzzaman Bipul, Md Rafiqul Islam. 
                        </div>

                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Area End Here -->
    </div>
    <!-- Main Body Area End Here -->

    <!-- Scrollable modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">
                        Search: <button id="search-close" type="button" class="btn btn-xs btn-secondary"
                            style="float: right;right: 19%;position: absolute;" data-dismiss="modal"><i
                                class="fa fa-times"></i></button>
                        <input type="text" name="live-searching" style="width: 75%;display: inline;"
                            class="form-control" id="live-searching" placeholder="live search.. ">
                        {{-- <button type="button btn-danger" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button> --}}
                        </h>
                </div>
                <div class="modal-body">
                    <div class="" style="padding-left: 2%;">

                        <ul class="search-output">
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var base_url = '{{ url('') }}/';

        $(function() {

            $('#search-button___').click(function() {
                $('#live-searching').val('');
                setTimeout(function() {

                    $('#live-searching').focus();
                }, 1000);
                $('.search-output').html('Search for products.');
            });

            $(document).on('keyup', '#live-searching', function(event) {
                event.preventDefault();

                var query = $(this).val();

                $.ajax({
                    data: {
                        query: query
                    },
                    url: "{{ route('customer.search_products') }}",
                    type: "POST",
                    dataType: "JSON",
                    success: function(result) {
                        // $('#exampleModal').modal('hide');
                        var lis = '';
                        if (result.status == 'success') {

                            $.each(result.data, function(index, el) {

                                lis +=
                                    '<li style="padding-top:6px;padding-bottom:6px;">' +
                                    '<img class="search-img" src="' + base_url + el
                                    .image +
                                    '/ " alt-=" no image " /> &nbsp;' +
                                    '<a href="' + base_url + 'my/product-details/' + el
                                    .id +
                                    '"> ' + el
                                    .name + ' &raquo;</a>' +
                                    '</li>';
                            });

                            if (!lis)
                                lis =
                                '<li style="padding-top:6px;padding-bottom:6px;">No product match your search!</li>';

                            $('.search-output').html(lis);

                            $(document).find('.search-img').each(function() {

                                $(this).error(function() {
                                    $(this).prop('src', base_url +
                                        'backend/upload/null.png');
                                });
                            });
                        };
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });

            });


        });
    </script>

    <!-- jquery-->
    <!-- Plugins js -->
    <script src="{{ url('/') }}/frontend2/js/plugins.js" type="text/javascript"></script>
    <!-- Bootstrap js -->
    <script src="{{ url('/') }}/frontend2/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- WOW JS -->
    <script src="{{ url('/') }}/frontend2/js/wow.min.js"></script>
    <!-- Nivo slider js -->
    <script src="{{ url('/') }}/frontend2/vendor/slider/js/jquery.nivo.slider.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/frontend2/vendor/slider/home.js" type="text/javascript"></script>
    <!-- Owl Cauosel JS -->
    <script src="{{ url('/') }}/frontend2/vendor/OwlCarousel/owl.carousel.min.js" type="text/javascript"></script>
    <!-- Meanmenu Js -->
    <script src="{{ url('/') }}/frontend2/js/jquery.meanmenu.min.js" type="text/javascript"></script>
    <!-- Srollup js -->
    <script src="{{ url('/') }}/frontend2/js/jquery.scrollUp.min.js" type="text/javascript"></script>
    <!-- jquery.counterup js -->
    <script src="{{ url('/') }}/frontend2/js/jquery.counterup.min.js"></script>
    <script src="{{ url('/') }}/frontend2/js/waypoints.min.js"></script>
    <!-- Countdown js -->
    <script src="{{ url('/') }}/frontend2/js/jquery.countdown.min.js" type="text/javascript"></script>
    <!-- Isotope js -->
    <script src="{{ url('/') }}/frontend2/js/isotope.pkgd.min.js" type="text/javascript"></script>
    <!-- Magic Popup js -->
    <script src="{{ url('/') }}/frontend2/js/jquery.magnific-popup.min.js" type="text/javascript"></script>
    <!-- Gridrotator js -->
    <script src="{{ url('/') }}/frontend2/js/jquery.gridrotator.js" type="text/javascript"></script>
    <!-- Custom Js -->
    <script src="{{ url('/') }}/frontend2/js/main.js" type="text/javascript"></script>
</body>

</html>
