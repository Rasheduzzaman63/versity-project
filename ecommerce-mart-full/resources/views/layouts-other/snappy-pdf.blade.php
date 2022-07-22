<!DOCTYPE html>
<html>

<head>
    <title>{{ isset($title) ? $title . ' ' : '' }} <?= date('d-M-Y ') . time() ?></title>
    <link rel="stylesheet" href="{{ url('css/bootstrap_3_7.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/pdf.css') }}">
    <style type="text/css">
        table,
        tr,
        td,
        th,
        tbody,
        thead,
        tfoot {
            /*page-break-inside: avoid!important;		    */
        }
    </style>
    <script src="{{ url('/') }}/frontend2/js/jquery-2.2.4.min.js" type="text/javascript"></script>
</head>

<body>
    <div class="container">
        @yield('content')
    </div>
    <div style="width: 100%; text-align: center; position: fixed;bottom: 0;height: 20px;" id="footer">
        This is computer generated summary.
    </div>
</body>

</html>
