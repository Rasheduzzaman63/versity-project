@extends('acewebv.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="panel panel-">
                <div class="panel-heading">
                    <strong>All Products</strong>
                </div>
                <div class="panel-body">

                    @foreach ($catData as $key => $product)
                        <div class="col-md-4">
                            <figure class="card card-product">
                                <div class="img-wrap">
                                    <a href="{{ route('customer.products.details', $product->id) }}">
                                        <img class="img-responsive"
                                            src="{{ !empty($product->image) ? url($product->image) : url('backend/upload/null.png') }}"
                                            style="height: 250px; width: 100%;">
                                    </a>
                                </div>
                                <figcaption class="info-wrap">
                                    <h5 class="title text-dots"><a
                                            href="{{ route('customer.products.details', $product->id) }}">{{ $product->name }}</a>
                                    </h5>
                                    <div class="action-wrap">
                                        <a href="{{ route('customer.cart.product_store', $product->id) }}"
                                            class="btn btn-primary btn-sm float-right">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Add To
                                            Cart/Bag</a>
                                        <div class="price-wrap h5">
                                            <span class="price-new">{{ $product->price }} Tk.</span>
                                        </div> <!-- price-wrap.// -->
                                    </div> <!-- action-wrap -->
                                </figcaption>
                            </figure> <!-- card // -->
                        </div> <!-- col // -->
                    @endforeach



                </div>
                <div class="panel-footer- float-right">
                    {{ $catData->links() }}
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
