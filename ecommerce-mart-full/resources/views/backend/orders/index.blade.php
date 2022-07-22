@extends('adminlte.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-lg-12 pt-2">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title d-inline-block">Order List</h3>
                        <a href="javascript:void(0)" class="float-right btn btn-primary btn-sm" id="create-new-Order"
                            onclick="addOrder()">
                            <i class="fas fa-plus"></i> Add Order
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data_table" class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th width="5%">SL.</th>
                                        <th>Member</th>
										<th>Payment</th>
										<th>Order No</th>
										<th>Order Total</th>
										<th>Shipping Date</th>
										<th>Address</th>
										<th>Status</th>

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
    <div class="modal fade" id="Order-create-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Order</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_form" role="form" class="form-inline" enctype="multipart/form-data">
                        
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="member_id" class="col-sm-4 mr-2">Member:</label>
                            <select class=" chosen" name="member_id" id="member_id"  required>
                                <option value="">Select</option>
                                @foreach ($members as $getValue)
                                    <option value="{{$getValue->id}}">{{$getValue->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="payment_id" class="col-sm-4 mr-2">Payment:</label>
                            <select class=" chosen" name="payment_id" id="payment_id"  required>
                                <option value="">Select</option>
                                @foreach ($payments as $getValue)
                                    <option value="{{$getValue->id}}">{{$getValue->trx_num}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="order_no" class="col-sm-4 mr-2">Order No:</label>
                            <input type="text" class="form-control" id="order_no" name="order_no" placeholder="" required>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="order_total" class="col-sm-4 mr-2">Order Total:</label>
                            <input type="float" class="form-control" id="order_total" name="order_total" placeholder=""  required>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="shipping_date" class="col-sm-4 mr-2">Shipping Date:</label>
                            <input type="date" class="form-control " id="shipping_date" name="shipping_date" placeholder="" required>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="address" class="col-sm-4 mr-2">Address:</label>
                            <textarea class="form-control" id="address" name="address" required></textarea>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="status" class="col-sm-4 mr-2">Status:</label>
                            <select class="form-control" name="status" id="status"  required>
                                <option value="">Select</option>
                                <option value="Pending">Pending</option><option value="Accepted">Accepted</option><option value="Shipping">Shipping</option><option value="Delivered">Delivered</option><option value="Cancelled">Cancelled</option>
                            </select>
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
    <div class="modal fade" id="Order-edit-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Order</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_form" role="form" class="form-inline" enctype="multipart/form-data">
                        @method('PUT')

                        
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="member_id" class="col-sm-4 mr-2">Member:</label>
                            <select class=" chosen" name="member_id" id="member_id"  required>
                                <option value="">Select</option>
                                @foreach ($members as $getValue)
                                    <option value="{{$getValue->id}}">{{$getValue->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="payment_id" class="col-sm-4 mr-2">Payment:</label>
                            <select class=" chosen" name="payment_id" id="payment_id"  required>
                                <option value="">Select</option>
                                @foreach ($payments as $getValue)
                                    <option value="{{$getValue->id}}">{{$getValue->trx_num}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="order_no" class="col-sm-4 mr-2">Order No:</label>
                            <input type="text" class="form-control" id="order_no" name="order_no" placeholder="" required>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="order_total" class="col-sm-4 mr-2">Order Total:</label>
                            <input type="float" class="form-control" id="order_total" name="order_total" placeholder=""  required>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="shipping_date" class="col-sm-4 mr-2">Shipping Date:</label>
                            <input type="date" class="form-control " id="shipping_date" name="shipping_date" placeholder="" required>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="address" class="col-sm-4 mr-2">Address:</label>
                            <textarea class="form-control" id="address" name="address" required></textarea>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="status" class="col-sm-4 mr-2">Status:</label>
                            <select class="form-control" name="status" id="status"  required>
                                <option value="">Select</option>
                                <option value="Pending">Pending</option><option value="Accepted">Accepted</option><option value="Shipping">Shipping</option><option value="Delivered">Delivered</option><option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                    <div class="clearfix"></div>
                
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                    <label for="" class="col-sm-4 mr-2">&nbsp;</label>
                    <button class="btn btn-sm btn-primary w-25" type="submit"> Save </button>
                </div>

                        <input type="hidden" name="Order_id" id="Order_id">
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

            table = $('#data_table').on( 'error.dt', function ( e, settings, techNote, message ) {
                // for datatable error
                if(confirm('Please reload this page and check.')){
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
                    url: "{{ route('orders.index') }}",
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
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},

                    {data: 'members_relation', name: 'members_relation.name'},
					{data: 'payments_relation', name: 'payments_relation.trx_num'},
					{data: 'order_no', name: 'order_no'},
					{data: 'order_total', name: 'order_total'},
					{data: 'shipping_date', name: 'shipping_date'},
					{data: 'address', name: 'address'},
					{data: 'status', name: 'status'},
					
                    
                    {data: 'action', name: 'action', orderable: false, searchable: false},
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
                            columns: [0,1,2,3,4,5,6,7],
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

                drawCallback: function( settings ) {
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
                    url: "{{ route('orders.store') }}",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $.notify(data.message, data.status);
                        if (data.status == 'success') {
                            $('#add_form').trigger("reset");
                            $('#Order-create-modal').modal('hide');
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
                var Order_id = $("#Order_id").val();
                var form_data = new FormData(this);

                let _url = `orders/` + Order_id;

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
                            $('#Order-edit-modal').modal('hide');
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

        function editOrder(event) {
            $('#edit_form').trigger("reset");
            var id = $(event.target).data("id");
            let _url = 'orders/' + id;

            $.ajax({
                url: _url,
                type: "GET",
                success: function(response) {
                    if (response) {
                        $("#Order_id").val(response.id);
                        
                        $('#edit_form #member_id').val(response.member_id);
						setTimeout(function() {
                            $("#edit_form #member_id").trigger("chosen:updated");
                        }, 200);

						$('#edit_form #payment_id').val(response.payment_id);
						setTimeout(function() {
                            $("#edit_form #payment_id").trigger("chosen:updated");
                        }, 200);

						$('#edit_form #order_no').val(response.order_no);
						$('#edit_form #order_total').val(response.order_total);
						$('#edit_form #shipping_date').val(response.shipping_date);
						$('#edit_form #address').text(response.address);
						$('#edit_form #status').val(response.status);

                        $('#Order-edit-modal').modal('show');
                    }
                }
            });
        }

        function addOrder() {

            $('#Order-create-modal').modal('show');
            $('#add_form').trigger("reset");
        }
    </script>
@endsection