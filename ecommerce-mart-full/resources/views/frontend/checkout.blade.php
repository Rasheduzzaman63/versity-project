@extends('acewebv.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="panel panel-">
                <div class="panel-heading">
                    <h4>Checkout </h4>
                </div>
                <div class="panel-body">
                    <form id="order_form" action="{{ route('customer.payment.store') }}" method="post">
                        @csrf
                        <p>
                            Please complete the bKash payment first. Then fill up the form below. Also note that 1.85% bKash
                            "cash out" cost will be added with net price.
                        </p>

                        <p>Total Cart Amount: <b>{{ $cart_list->sum('price') }}</b> Tk.</p>
                        <p>bKash Cashout Charge(1.85%): <b>{{ $cart_list->sum('price') * 0.0185 }}</b> Tk.</p>
                        <p>
                            <b>Total Payable Amount:
                                {{ $cart_list->sum('price') + $cart_list->sum('price') * 0.0185 }}</b>
                            Tk.

                            <input type="text" name="order_total" id=""
                                value="{{ $cart_list->sum('price') + $cart_list->sum('price') * 0.0185 }}">
                        </p>
                        <p>
                            bKash Personal Number: 01700000000
                            <input type="hidden" name="payment_to_mobile" value="01700000000" />
                        </p>
                        <p>
                            Delivery Date: <input required type="date" class="form-control" name="shipping_date"
                                style="width: 40%" />
                        </p>
                        <p>
                            Address:
                            <textarea required class="form-control" name="address" style="width: 40%">{{ session('member_data')->address }}</textarea>
                        </p>
                        <div class="col-md-7">
                            <b>Payment Type:</b>
                            <input type="radio" id="cash_on_delivery" value="cash_on_delivery" name="payment_method" />
                            <label for="cash_on_delivery">Cash on Delivery</label>
                            <input type="radio" id="bKash" checked value="bKash" name="payment_method" />
                            <label for="bKash">bKash</label>

                            <hr>
                            <div id="bKash_div">
                                <span href="#" class="list-group-item active">
                                    bKash Checkout
                                </span>
                                <div class="table-responsive">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <tbody>
                                            <tr class="">
                                                <th>Your bKash Mobile No:</th>
                                                <td>
                                                    <input required="" type="text" class="form-control"
                                                        name="payment_from_mobile" value="-" />
                                                </td>
                                            </tr>
                                            <tr class="">
                                                <th>Transaction No:</th>
                                                <td>
                                                    <input required="" name="trx_num" type="text" class="form-control"
                                                        value="-" />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <table id="example2" class="table table-bordered table-striped">
                                <tbody>
                                    <tr class="">
                                        <td class="text-center">
                                            <button class="btn btn-primary" type="submit" style="width: 30%;"> Place Order
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="panel-footer- float-right">
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
    <script>
        $(function() {

            $('#cash_on_delivery').on('click', function(params) {
                if ($(this).is(':checked')) {
                    $('#bKash_div').hide(500);
                }
            });
            $('#bKash').on('click', function(params) {
                if ($(this).is(':checked')) {
                    $('#bKash_div').show(500);
                }
            });

            $('#slide-submenu').on('click', function() {
                $(this).closest('.list-group').fadeOut('slide', function() {
                    $('.mini-submenu').fadeIn();
                });

            });

            $('.mini-submenu').on('click', function() {
                $(this).next('.list-group').toggle('slide');
                $('.mini-submenu').hide();
            })
        })
    </script>
    <!-- jQuery Form Validation -->
@endsection
