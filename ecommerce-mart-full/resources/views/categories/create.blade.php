@extends('adminlte.app')

@section('content_title')
<strong> Create Category</strong>
@endsection

@section('content')

<div class="inner_body">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">

            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{route('categories.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">

                        <label class="control-label col-md-2 " for="name">Name</label>
                        <div class="col-md-3">
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', "") }}" >
                            @if($errors->has("name"))
                            <span class="help-block" role="alert">{{ $errors->first("name") }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">

                        <label class="control-label col-md-2 " for="created_by">Created By</label>
                        <div class="col-md-3">
                            <input class="form-control" type="text" name="created_by" id="created_by" value="{{ old('created_by', "") }}" >
                            @if($errors->has("created_by"))
                            <span class="help-block" role="alert">{{ $errors->first("created_by") }}</span>
                            @endif
                        </div>

                        <label class="control-label col-md-2 " for="updated_by">Updated By</label>
                        <div class="col-md-3">
                            <input class="form-control" type="text" name="updated_by" id="updated_by" value="{{ old('updated_by', "") }}" >
                            @if($errors->has("updated_by"))
                            <span class="help-block" role="alert">{{ $errors->first("updated_by") }}</span>
                            @endif
                        </div>
                    </div>
                
                    <div class="form-group">
                        <div class="col-md-3 col-md-offset-2">
                            <button class="btn  btn-sm btn-primary" type="submit">
                                Save
                            </button>
                        </div>
                    </div>
				
				</form>
            </div>
        </div>

    </div>
<script type="text/javascript">
    $(document).ready(function() {
        // $('textarea').summernote();
        
        $('#form_task').submit(function(event) {
            event.preventDefault();
            var data = $(this).serialize();
            $.ajax({
                url: '{{-- route('tasks.store') --}}',
                type: 'POST',
                dataType: 'json',
                data: data,
            })
            .done(function(result) {
                $.notify(result.message, 'success');
                $('#categories').trigger("reset");
            })
            .fail(function(err) {
                if (err.status == 422) {

                    $.each(err.responseJSON.errors, function (i, error) {
                        var el = $(document).find('[name="'+i+'"]');
                        // el.after($('<span style="color: red;">'+error[0]+'</span>'));
                        $.notify(error[0], 'warning');
                    });
                }
            });
        });
    });
</script>

@endsection
