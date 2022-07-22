@extends('acewebv.app')
@section('content')
    <style>
        element {}

        .contact-us-page1-area {
            padding: 0px 0 0;
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="panel panel-">
                <div class="panel-heading">
                    {{-- <h3>Contact Us </h3> --}}
                </div>
                <div class="panel-body">
                    <h3>Contact Us </h3>

                    <!-- Contact Us Page 1 Area Start Here -->
                    <div class="contact-us-page1-area">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="contact-us-info1">
                                    <ul>
                                        <li>
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                            <h3>Phone</h3>
                                            <p>{{ config('app_settings.site_phone') }}</p>
                                        </li>
                                        <li>
                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <h3>Address</h3>
                                            <p>{{ config('app_settings.site_address') }}</p>
                                        </li>
                                        <li>
                                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                            <h3>E-mail</h3>
                                            <p>{{ config('app_settings.site_email') }}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="panel-footer- float-right">
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
    <script>
        $(function() {

        });
    </script>
    <!-- jQuery Form Validation -->
@endsection
