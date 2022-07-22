@extends('adminlte.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-lg-12 pt-2">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title d-inline-block">Member List</h3>
                        <a href="javascript:void(0)" class="float-right btn btn-primary btn-sm" id="create-new-Member"
                            onclick="addMember()">
                            <i class="fas fa-plus"></i> Add Member
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data_table" class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th width="5%">SL.</th>
                                        <th>Name</th>
										<th>Email</th>
										<th>Password</th>
										<th>Phone</th>
										<th>Address</th>
										<th>Status</th>
										<th>Image</th>
										<th>Remember Token</th>

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
    <div class="modal fade" id="Member-create-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Member</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_form" role="form" class="form-inline" enctype="multipart/form-data">
                        
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="name" class="col-sm-4 mr-2">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="" required>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="email" class="col-sm-4 mr-2">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="" required>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="password" class="col-sm-4 mr-2">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="" required>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="phone" class="col-sm-4 mr-2">Phone:</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="" required>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="address" class="col-sm-4 mr-2">Address:</label>
                            <textarea class="form-control" id="address" name="address" required></textarea>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="status" class="col-sm-4 mr-2">Status:</label>
                            <input type="radio" name="status" value="Active" />Active &nbsp;<input type="radio" name="status" value="Inactive" />Inactive &nbsp;
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="image" class="col-sm-4 mr-2">Image:</label>
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
                                        <input type="file" name="image" id="image" accept="image/*"  />
                                    </span>
                                    <a href="#" class="btn btn-sm btn-danger btn-outline- fileinput-exists"
                                        data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="remember_token" class="col-sm-4 mr-2">Remember Token:</label>
                            <input type="text" class="form-control" id="remember_token" name="remember_token" placeholder="" >
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
    <div class="modal fade" id="Member-edit-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Member</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_form" role="form" class="form-inline" enctype="multipart/form-data">
                        @method('PUT')

                        
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="name" class="col-sm-4 mr-2">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="" required>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="email" class="col-sm-4 mr-2">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="" required>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="password" class="col-sm-4 mr-2">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="" required>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="phone" class="col-sm-4 mr-2">Phone:</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="" required>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="address" class="col-sm-4 mr-2">Address:</label>
                            <textarea class="form-control" id="address" name="address" required></textarea>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="status" class="col-sm-4 mr-2">Status:</label>
                            <input type="radio" name="status" value="Active" />Active &nbsp;<input type="radio" name="status" value="Inactive" />Inactive &nbsp;
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="image" class="col-sm-4 mr-2">Image:</label>
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
                                        <input type="file" name="image" id="image" accept="image/*"  />
                                    </span>
                                    <a href="#" class="btn btn-sm btn-danger btn-outline- fileinput-exists"
                                        data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <label for="remember_token" class="col-sm-4 mr-2">Remember Token:</label>
                            <input type="text" class="form-control" id="remember_token" name="remember_token" placeholder="" >
                        </div>
                    <div class="clearfix"></div>
                
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                    <label for="" class="col-sm-4 mr-2">&nbsp;</label>
                    <button class="btn btn-sm btn-primary w-25" type="submit"> Save </button>
                </div>

                        <input type="hidden" name="Member_id" id="Member_id">
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
                    url: "{{ route('members.index') }}",
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

                    {data: 'name', name: 'name'},
					{data: 'email', name: 'email'},
					{data: 'password', name: 'password'},
					{data: 'phone', name: 'phone'},
					{data: 'address', name: 'address'},
					{data: 'status', name: 'status'},
					{data: 'image', name: 'image',
						render: function(data, type, full, meta) {
							return '<img class="page_image" src="' + base_url + data +
                                '" height="50" alt="image" >';
						}
					},
					{data: 'remember_token', name: 'remember_token'},
					
                    
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
                            columns: [0,1,2,3,4,5,6,7,8],
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
                    url: "{{ route('members.store') }}",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $.notify(data.message, data.status);
                        if (data.status == 'success') {
                            $('#add_form').trigger("reset");
                            $('#Member-create-modal').modal('hide');
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
                var Member_id = $("#Member_id").val();
                var form_data = new FormData(this);

                let _url = `members/` + Member_id;

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
                            $('#Member-edit-modal').modal('hide');
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

        function editMember(event) {
            $('#edit_form').trigger("reset");
            var id = $(event.target).data("id");
            let _url = 'members/' + id;

            $.ajax({
                url: _url,
                type: "GET",
                success: function(response) {
                    if (response) {
                        $("#Member_id").val(response.id);
                        
                        $('#edit_form #name').val(response.name);
						$('#edit_form #email').val(response.email);
						$('#edit_form #password').val(response.password);
						$('#edit_form #phone').val(response.phone);
						$('#edit_form #address').text(response.address);
						$('#edit_form').find('input[name=status][value='+response.status+']').attr('checked', true);
						$('#edit_form #image').closest('.fileinput').find('img').prop('src', response.image);
						$('#edit_form #remember_token').val(response.remember_token);

                        $('#Member-edit-modal').modal('show');
                    }
                }
            });
        }

        function addMember() {

            $('#Member-create-modal').modal('show');
            $('#add_form').trigger("reset");
        }
    </script>
@endsection