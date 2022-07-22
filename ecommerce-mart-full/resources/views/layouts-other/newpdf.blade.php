<!DOCTYPE html>
<html>

<head>
    <title>{{ isset($title) ? $title : 'title' }}</title>
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap_3_7.min.css') }}">
    <style type="text/css">
        @page {
            header: page-header;
            footer: page-footer;
        }

        * {
            box-sizing: border-box !important;
        }

        table {
            border-collapse: collapse;
        }

        h2 h3 {
            margin: 0;
            padding: 0;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }

        .table .table {
            background-color: #fff;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        table tr td {
            padding: 2px;
        }

        table td,
        table th {
            vertical-align: middle !important;
        }

        .table-bordered thead th,
        .table-bordered td,
        .table-bordered th {
            border: 1px solid black !important;
        }

        .table-bordered thead th {
            background-color: #cacaca;
        }

        strong {
            font-weight: bold;
            font-size: 13px;
        }

        body {
            font-size: 12px;
        }

    </style>
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap_3_7.min.css') }}">
    @yield('styles')
</head>

<body>
    @yield('first_top_content')
    <htmlpageheader name="page-header">
        <img style="width:50px; height: 50px; position: absolute; left: 70px; top: 0px; margin-left: 10px;"
            src="{{ url('public/backend/images/logo.png') }}">
        <div class="text-center" style="margin-top: -50px;">
            <h3 style="margin: 0px;">Heading</h3>
            <h5 style="margin: 0px;"><strong>Dhaka</strong></h5>
        </div>
    </htmlpageheader>
    <div class="container">
        @yield('content')
    </div>
    <htmlpagefooter name="page-footer">
        <div class="container" style="padding-right: 40px; padding-left: 35px;">
            <div class="row">
                <div class="col-xs-3">
                    {{ date('d-M-y, h:i:s A') }}
                </div>
                <div class="col-xs-6">
                    <p style="text-align: center; margin: 0px;">Powered By <b>Company Name.</b> Mobile: 00</p>
                </div>
                <div class="co-xs-3 text-right">
                    Page {PAGENO} of {nb} Pages
                </div>
            </div>
        </div>

    </htmlpagefooter>
</body>

</html>
