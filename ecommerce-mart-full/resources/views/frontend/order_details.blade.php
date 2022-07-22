@extends('acewebv.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <hr>
            <div class="panel panel-primary" style="margin-bottom: none;">
                <div class="panel-heading">
                    <strong>Order Details </strong>
                </div>
                <div class="panel-body">
                    <a target="_blank" href="{{ url('my/order/pdf/' . $order->id) }}" class="btn btn-success btn-sm "
                        style="margin-bottom: 5px;">
                        <i class="fa fa-print"></i> Print Order
                    </a>
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
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
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
