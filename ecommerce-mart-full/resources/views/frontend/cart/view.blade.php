@extends('acewebv.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="panel panel-">
                <div class="panel-heading">
                    <h4>My Cart</h4>
                </div>
                <div class="panel-body">

                    <form id="cart_form" action="{{ route('customer.cart.store') }}" method="post">
                        @csrf
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead class="primary">
                                    <tr>
                                        <th width="6%">SL.</th>
                                        <th>Product Name</th>
                                        <th>Product Image</th>
                                        <th>Unit Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Total Price</th>

                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($cart_list)
                                        @foreach ($cart_list as $key => $cart)
                                            <tr class="{{ $cart->id }}">

                                                <input name="product_id[]" hidden value="{{ $cart->product->id }}" />

                                                <td>{{ $key + 1 }}.</td>
                                                <td>
                                                    <a href="{{ url('my/product-details/' . $cart->product->id) }}">
                                                        {{ $cart->product->name }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <img class="img-responsive"
                                                        src="{{ !empty($cart->product->image) ? url($cart->product->image) : url('backend/upload/null.png') }}"
                                                        style="height: 60px; width: 60px;">
                                                </td>
                                                <td class="product_price">{{ $cart->product->price }}</td>
                                                <td class="text-right">
                                                    <input name="product_qty[]" class="product_qty text-right"
                                                        type="number" min="1" style="width: 30%"
                                                        value="{{ $cart->quantity }}" />
                                                </td>
                                                <td class="text-right">
                                                    <input class="product_total_price text-right" type="number"
                                                        min="0" readonly value="{{ $cart->price }}"
                                                        style="width: 50%" />
                                                </td>
                                                <td>
                                                    <a class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure to remove product from cart?')"
                                                        href="{{ url('my/cart/product/delete/' . $cart->id) }}">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </a>
                                                    {{-- <button class="remove_cart btn btn-danger btn-sm">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </button> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center">Your cart is empty! <a
                                                    href="{{ route('/') }}" class="btn btn-sm btn-primary">Buy
                                                    Products &raquo;</a></td>
                                        </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4">
                                        </th>
                                        <th class="text-right">
                                            Total Quantity= <span id="quantity_total"></span>
                                        </th>
                                        <th class="text-right">
                                            Grand Total Price= <span id="price_total"></span>
                                        </th>
                                        <th class="text-right">
                                            &nbsp;
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="3">
                                        </th>
                                        <th class="text-right">
                                            <a class="btn btn-primary" href="{{ route('/') }}">Shop More</a>
                                        </th>
                                        <th class="text-right">
                                            <button id="cart_submit_btn" class="btn btn-info">Update Cart</button>
                                        </th>
                                        <th class="text-right">
                                            <button id="checkout_btn" class="btn btn-success">Check Out</button>
                                        </th>
                                        <th class="text-right">
                                            &nbsp;
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <input type="hidden" name="checkout" />
                    </form>
                    <script>
                        function calculate_total() {
                            let total_price = 0;
                            let total_qty = 0;
                            let count = 0;
                            $('.product_total_price').each(function() {
                                total_price += $(this).val() - 0;
                                total_qty += $(this).closest('tr').find('.product_qty').val() - 0;
                                count++;
                            });
                            $('#quantity_total').text(total_qty);
                            $('#price_total').text(total_price);
                            if (!count) {

                            }
                        }
                        $(document).ready(function() {

                            calculate_total();

                            $(document).on('change keyup focus blur', '.product_qty', function() {
                                var qty = $(this).val() - 0;

                                var product_price = $(this).closest('tr').find('.product_price').text() - 0;

                                var product_total_price = product_price * qty;

                                var qty = $(this).closest('tr').find('.product_total_price').val(product_total_price);

                                calculate_total();
                            });
                            $(document).on('click', '.remove_cart', function() {

                                if (confirm('Are you sure to remove product from your cart?')) {
                                    $(this).closest('tr').remove();
                                    calculate_total();
                                }
                            });
                            $(document).on('click', '#cart_submit_btn', function(e) {
                                e.preventDefault();

                                $('input[name="checkout"]').val(0);

                                $('#cart_form').submit();
                            });
                            $(document).on('click', '#checkout_btn', function(e) {
                                e.preventDefault();

                                $('input[name="checkout"]').val(1);

                                $('#cart_form').submit();
                            });
                        })
                    </script>

                </div>
                <div class="panel-footer- float-right">

                </div>

            </div>

        </div>
    </div><!-- /.container-fluid -->

    <script>
        $(function() {

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
