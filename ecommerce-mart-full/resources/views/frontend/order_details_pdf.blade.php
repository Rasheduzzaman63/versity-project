@extends('layouts-other.snappy-pdf')

@section('content')
    <style type="text/css">
        td,
        .table>tfoot>tr>td {
            /*padding: 4px !important;                                                                                                                                                                        line-height: 1 !important;*/
            /*vertical-align: top !important;*/
        }

        .datatable-Employee {
            margin-top: 30px;
        }
    </style>

    <div name="page-header">
        <br>
        <img style="width:130px; height: 47px; margin-left: 10px;" src="{{ url('images/ecommerce-logo.jpg') }}">
        <div class="text-center" style="margin-top: -50px;">
            <h4 style="margin: 0px;padding-bottom: 5px; font-weight: bold; font-family: sans-serif;">
                Order Details
            </h4>
            <div style="margin: 0px;padding-bottom: 10px; font-size: 12px; font-family: sans-serif;">

                <strong>{{ config('app_settings.application_title') }},</strong>
                {{ config('app_settings.site_address') }}
            </div>
        </div>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-12">
                <br>
                <div class="panel panel-primary" style="margin-bottom: none;">
                    <div class="panel-heading">
                        <strong>Order Details </strong>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="data_table" class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>Order No.</th>
                                        <td>{{ $order->order_no }}</td>
                                        <th>Order Total:</th>
                                        <td>{{ $order->order_total }} Tk.</td>
                                    </tr>
                                    <tr>
                                        <th>Shipping Date:</th>
                                        <td>{{ $order->shipping_date }}</td>
                                        <th>Status:</th>
                                        <td>{{ $order->status }}</td>
                                    </tr>
                                    <tr>
                                        <th>Delivery Address:</th>
                                        <td>{{ $order->address }}</td>
                                        <th>&nbsp;</th>
                                        <td>&nbsp;< /td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <br>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <strong>Product List </strong>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="data_table" class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th width="5%">SL.</th>
                                        <th>Product Name</th>
                                        <th>Product Image</th>
                                        <th>Product Quantity</th>
                                        <th>Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order_details as $key => $value)
                                        <tr>
                                            <td>{{ $key + 1 }}.</td>
                                            <td>{{ $value->product_name }}</td>
                                            <td>
                                                <img style="height: 65px; "
                                                    src="{{ !empty($value->product_image) ? url($value->product_image) : url('backend/upload/null.png') }}"
                                                    alt="" />
                                            </td>
                                            <th class="text-right">{{ $value->quantity }}</th>
                                            <th class="text-right">{{ $value->price }} Tk.</th>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <br>
                <div class="panel panel-primary" style="margin-bottom: none;">
                    <div class="panel-heading">
                        <strong>Customer Details </strong>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="data_table" class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name:</th>
                                        <td>{{ session('member_data')->name }}</td>
                                        <th>Phone:</th>
                                        <td>{{ session('member_data')->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>E-mail:</th>
                                        <td>{{ session('member_data')->email }}</td>
                                        <th>Image:</th>
                                        <?php
                                        $member_image = session('member_data')->image ?? '-';
                                        ?>
                                        <td>
                                            <img style="height: 75px;" src="{{ url($member_image) }}" alt="" />
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </div>
    <button id="print_btn" style="display: none;" onclick="window.print()">Print this page</button>
    <script type="text/javascript">
        $(document).ready(function(){

            setTimeout(function() {

                $('#print_btn').click();

            }, 200);

        });
    </script>
@endsection
