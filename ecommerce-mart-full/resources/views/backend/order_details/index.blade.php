@extends('adminlte.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-lg-12 pt-2">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title d-inline-block">OrderDetails List</h3>
                        <a href="javascript:void(0)" class="float-right btn btn-primary btn-sm" id="create-new-Order_Details"
                            onclick="addOrderDetails()">
                            <i class="fas fa-plus"></i> Add OrderDetails
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data_table" class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th width="5%">SL.</th>
                                        <th>Order</th>
                                        <th>Product</th>
                                        <th>Product Name</th>
                                        <th>Product Image</th>
                                        <th>Quantity</th>
                                        <th>Price</th>

                                        <th width="13%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Add data -->
    <div class="modal fade" id="Order_Details-create-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create OrderDetails</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_form" role="form" class="form-inline" enctype="multipart/form-data">

                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="order_id" class="col-sm-4 mr-2">Order:</label>
                            <select class=" chosen" name="order_id" id="order_id" required>
                                <option value="">Select</option>
                                @foreach ($orders as $getValue)
                                    <option value="{{ $getValue->id }}">{{ $getValue->order_no }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="product_id" class="col-sm-4 mr-2">Product:</label>
                            <select class=" chosen" name="product_id" id="product_id" required>
                                <option value="">Select</option>
                                @foreach ($products as $getValue)
                                    <option value="{{ $getValue->id }}">{{ $getValue->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="product_name" class="col-sm-4 mr-2">Product Name:</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder=""
                                required>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="product_image" class="col-sm-4 mr-2">Image:</label>
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new img-thumbnail" style="width: 120px; height: 120px;">
                                    <img src="" alt="image" />
                                </div>
                                <div class="fileinput-preview fileinput-exists img-thumbnail"
                                    style="max-width: 120px; max-height: 120px;">
                                </div>
                                <div>
                                    <span class="btn btn-sm btn-info btn-outline- btn-file">
                                        <span class="fileinput-new">Select New Image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="product_image" id="product_image" accept="image/*" />
                                    </span>
                                    <a href="#" class="btn btn-sm btn-danger btn-outline- fileinput-exists"
                                        data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="quantity" class="col-sm-4 mr-2">Quantity:</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder=""
                                required>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="price" class="col-sm-4 mr-2">Price:</label>
                            <input type="float" class="form-control" id="price" name="price" placeholder=""
                                required>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="" class="col-sm-4 mr-2">&nbsp;</label>
                            <button class="btn btn-sm btn-primary w-25" type="submit"> Save </button>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit data -->
    <div class="modal fade" id="Order_Details-edit-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit OrderDetails</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_form" role="form" class="form-inline" enctype="multipart/form-data">
                        @method('PUT')


                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="order_id" class="col-sm-4 mr-2">Order:</label>
                            <select class=" chosen" name="order_id" id="order_id" required>
                                <option value="">Select</option>
                                @foreach ($orders as $getValue)
                                    <option value="{{ $getValue->id }}">{{ $getValue->order_no }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="product_id" class="col-sm-4 mr-2">Product:</label>
                            <select class=" chosen" name="product_id" id="product_id" required>
                                <option value="">Select</option>
                                @foreach ($products as $getValue)
                                    <option value="{{ $getValue->id }}">{{ $getValue->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="product_name" class="col-sm-4 mr-2">Product Name:</label>
                            <input type="text" class="form-control" id="product_name" name="product_name"
                                placeholder="" required>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="product_image" class="col-sm-4 mr-2">Image:</label>
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new img-thumbnail" style="width: 120px; height: 120px;">
                                    <img src="" alt="image" />
                                </div>
                                <div class="fileinput-preview fileinput-exists img-thumbnail"
                                    style="max-width: 120px; max-height: 120px;">
                                </div>
                                <div>
                                    <span class="btn btn-sm btn-info btn-outline- btn-file">
                                        <span class="fileinput-new">Select New Image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="product_image" id="product_image"
                                            accept="image/*" />
                                    </span>
                                    <a href="#" class="btn btn-sm btn-danger btn-outline- fileinput-exists"
                                        data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="quantity" class="col-sm-4 mr-2">Quantity:</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder=""
                                required>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="price" class="col-sm-4 mr-2">Price:</label>
                            <input type="float" class="form-control" id="price" name="price" placeholder=""
                                required>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="" class="col-sm-4 mr-2">&nbsp;</label>
                            <button class="btn btn-sm btn-primary w-25" type="submit"> Save </button>
                        </div>

                        <input type="hidden" name="Order_Details_id" id="Order_Details_id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Data -->
    <script>
        var base_url = "{{ url('/') }}";
        var table = "";
        var qdata = {};

        $(document).ready(function() {
            let ttitle = document.title;
            let messageTop = '';
            let messageBottom = '';

            table = $('#data_table').on('error.dt', function(e, settings, techNote, message) {
                // for datatable error
                if (confirm('Please reload this page and check.')) {
                    location.reload();
                }
            }).DataTable({
                pageLength: 10,
                lengthMenu: [10, 20, 50, 100, 200, 500, 1000, 100000],
                processing: true,
                serverSide: true,
                serverMethod: 'get',
                //(main global search wotrks on enter)
                initComplete: function() {
                    $('.dataTables_filter input').unbind();
                    $('.dataTables_filter input').bind('keyup', function(e) {
                        var searchValue = $(this).val();
                        if (!searchValue) {
                            // search after input clear also
                            table.search(this.value).draw();
                        }

                        var code = e.keyCode || e.which;
                        if (code == 13) {
                            table.search(this.value).draw();
                        }
                    });
                },
                searching: true,
                mark: true,
                dom: 'Blfrtip',
                // searchBuilder: {
                // custom searchBuilder
                // dom: 'QBlfrtip',
                //     enterSearch: true
                // },
                ajax: {
                    url: "{{ route('order_details.index') }}",
                    data: qdata,
                    async: false,
                    error: function(jqXHR, ajaxOptions, thrownError) {
                        let em = jqXHR.responseJSON.message;
                        alert(em);
                        if (em.includes('Unauthenticated')) {
                            location.reload();
                        }
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },

                    {
                        data: 'orders_relation',
                        name: 'orders_relation.order_no'
                    },
                    {
                        data: 'products_relation',
                        name: 'products_relation.name'
                    },
                    {
                        data: 'product_name',
                        name: 'product_name'
                    },
                    {
                        data: 'product_image',
                        name: 'product_image',
                        render: function(data, type, full, meta) {
                            return '<img class="page_image" src="' + base_url + data +
                                '" height="50" alt="image" >';
                        }
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },


                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                fixedHeader: {
                    //for export in general
                    header: true,
                    headerOffset: $('#fixed').height()
                },

                buttons: [{
                        extend: 'print',
                        text: '<i class="fas fa-file-pdf"></i> Print/Save to PDF',
                        exportOptions: {
                            stripHtml: false, //for image show
                            columns: [0, 1, 2, 3, 4, 5, 6],
                        },
                        title: ttitle,
                        messageTop: function() {
                            return messageTop;
                        },
                        messageBottom: function() {
                            return '<h3 style="text-align:center">' + messageBottom + '</h3>';
                        },
                        customize: function(win) {

                            // this line is for centering messageTop
                            $(win.document.messageTop).css('text-align', 'center')

                            // for landscape print
                            var css =
                                '@page  { size: landscape; margin-top:30px; margin-botton:30px; }',
                                head = win.document.head || win.document.getElementsByTagName(
                                    'head')[0],
                                style = win.document.createElement('style');
                            style.type = 'text/css';
                            style.media = 'print';
                            if (style.styleSheet) {
                                style.styleSheet.cssText = css;
                            } else {
                                style.appendChild(win.document.createTextNode(css));
                            }
                            head.appendChild(style);
                            // for landscape end

                        },
                    },
                    {
                        text: '<div class="bg-info"><i class="fas fa-file-pdf"></i> Print/Save to PDF All.</div>',
                        action: function(e, dt, node, config) {
                            dt.page.len(-1).draw();
                            dt.button('.buttons-print').trigger();
                        }
                    },
                ],

                drawCallback: function(settings) {
                    // any js/jquery action after table draw
                    $(document).find('#data_table tr').each(function(index, el) {
                        let idd = $(el).closest('tr').find('.edit_btn').data('id');
                        $(el).addClass('row_' + idd);
                    });
                },
            });

            $(document).find('#data_table_filter label').append(' <small>(Press enter to see the result.)</small>');

            $('#add_form').submit(function(e) {
                e.preventDefault();
                var form_data = new FormData(this);

                $.ajax({
                    data: form_data,
                    url: "{{ route('order_details.store') }}",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $.notify(data.message, data.status);
                        if (data.status == 'success') {
                            $('#add_form').trigger("reset");
                            $('#Order_Details-create-modal').modal('hide');
                            table.draw();
                        }
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        if (data.status === 422) {
                            var response = JSON.parse(data.responseText);
                            var errors = response['errors'];
                            $.each(errors, function(key, val) {
                                $.notify(val[0], 'error');
                            });
                        }
                    }
                });
            });

            $('#edit_form').submit(function(e) {
                e.preventDefault();
                var Order_Details_id = $("#Order_Details_id").val();
                var form_data = new FormData(this);

                let _url = `order_details/` + Order_Details_id;

                $.ajax({
                    data: form_data,
                    url: _url,
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $.notify(data.message, data.status);
                        if (data.status == 'success') {

                            $('#edit_form').trigger("reset");
                            $('#Order_Details-edit-modal').modal('hide');
                            table.draw();
                        }
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        if (data.status === 422) {
                            var response = JSON.parse(data.responseText);
                            var errors = response['errors'];
                            $.each(errors, function(key, val) {
                                $.notify(val[0], 'error');
                            });
                        }
                    }
                });
            });
        });

        function editOrderDetails(event) {
            $('#edit_form').trigger("reset");
            var id = $(event.target).data("id");
            let _url = 'order_details/' + id;

            $.ajax({
                url: _url,
                type: "GET",
                success: function(response) {
                    if (response) {
                        $("#Order_Details_id").val(response.id);

                        $('#edit_form #order_id').val(response.order_id);
                        setTimeout(function() {
                            $("#edit_form #order_id").trigger("chosen:updated");
                        }, 200);

                        $('#edit_form #product_id').val(response.product_id);
                        setTimeout(function() {
                            $("#edit_form #product_id").trigger("chosen:updated");
                        }, 200);

                        $('#edit_form #product_name').val(response.product_name);
                        $('#edit_form #product_image').closest('.fileinput').find('img').prop('src', response
                            .product_image);
                        $('#edit_form #quantity').val(response.quantity);
                        $('#edit_form #price').val(response.price);

                        $('#Order_Details-edit-modal').modal('show');
                    }
                }
            });
        }

        function addOrderDetails() {

            $('#Order_Details-create-modal').modal('show');
            $('#add_form').trigger("reset");
        }
    </script>
@endsection
