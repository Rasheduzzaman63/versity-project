<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Summary</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend') }}/dist/css/adminlte.min.css">
</head>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h2 class="page-header">
                                <i class="fas fa-globe"></i> Gift Shop
                                <small class="float-right"></small>
                            </h2>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="col-md-6">
                        <h5>Note!</h5>

                        <span class="badge bg-danger">Your Order is {{ $order->status }}. </br>
                            After Approval Your Invoice ID will given.
                            However you can download your invoice from Order history => See Details.
                        </span>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            Address
                            <address>
                                <strong>{{ session('member_data')->UserName }}</strong><br>
                                Address: {{ session('member_data')->address }}<br>
                                Mobile: {{ session('member_data')->phone }}<br>
                                E-mail: {{ session('member_data')->email }}
                            </address>
                        </div>
                        <!-- /.col -->
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <b>Order ID: </b> {{ $order->id }}<br>
                            <b>Payment Date: </b>{{ $order['payment']['created_at'] }}<br>
                            <b>Payment Method: </b>{{ $order['payment']['payment_method'] }}<br>
                            <b>Transection ID: </b>{{ $order['payment']['trx_num'] }}<br>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped" style="text-align: center;">
                                <thead>
                                    <th class="">SL.</th>
                                    <th class="">Product Name</th>
                                    <th class="">Image</th>
                                    <th class="">Size</th>
                                    <th class="">Color</th>
                                    <th class="">Quantity</th>
                                    <th class="">Price</th>
                                    <th class="">Total</th>

                                </thead>
                                <tbody>
                                    @foreach ($orderDetails as $key => $orderItem)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $orderItem->product_name }}</td>

                                            <td>
                                                <img class="profile-user-img img-fluid img-square"
                                                    src="{{ !empty($orderItem->product_image) ? url('backend/upload/product_img/' . $orderItem->product_image) : url('backend/upload/null.png') }}"
                                                    style="width:50px; height: 50px;">

                                            </td>
                                            <td style="text-align: center;">{{ $orderItem->quantity }}</td>
                                            <td>{{ $orderItem->price }}</td>
                                            <td>{{ $orderItem->price * $orderItem->quantity }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-8">

                        </div>
                        <!-- /.col -->
                        <div class="col-4 float-right">

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <th colspan="10">Grand Total:</th>
                                    <td style="text-align: center;" colspan="2">
                                    </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
            </div>
        </section>

        <!-- /.content -->
        <script type="text/javascript">
            $("#success-alert").fadeTo(3000, 1000).slideUp(1000, function() {
                $("#success-alert").slideUp(1000);
            });
        </script>
    </div>



    <!-- ./wrapper -->
    <!-- Page specific script -->
    <!--<script>
        window.addEventListener("load", window.print());
    </script>-->
</body>

</html>
