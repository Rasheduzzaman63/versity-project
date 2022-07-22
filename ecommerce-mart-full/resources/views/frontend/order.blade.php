@extends('acewebv.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="panel panel-">
                <div class="panel-heading">
                    <h4>My Orders </h4>
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table id="data_table" class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">SL.</th>
                                    <th>Order No</th>
                                    <th>Shipping Date</th>
                                    <th>Status</th>
                                    <th>Payment Method</th>
                                    <th>Transaction No.</th>
                                    <th>Payment From</th>
                                    <th>Payment To</th>
                                    <th>Order Total</th>
                                    <th>Address</th>
                                    <th width="11%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart_list as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}.</td>
                                        <td>{{ $value->order_no }}</td>
                                        <td>{{ $value->shipping_date }}</td>
                                        <td>{{ $value->status }}</td>
                                        <td>{{ $value->payments_relation->payment_method }}</td>
                                        <td>{{ $value->payments_relation->trx_num }}</td>
                                        <td>{{ $value->payments_relation->payment_from_mobile }}</td>
                                        <td>{{ $value->payments_relation->payment_to_mobile }}</td>
                                        <td>{{ $value->order_total }}</td>
                                        <td>{{ $value->address }}</td>
                                        <td>
                                            <a href="{{ route('customer.order.details', $value->id) }}">
                                                <i class="fa fa-eye"></i> Details
                                            </a>
                                        </td>
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
