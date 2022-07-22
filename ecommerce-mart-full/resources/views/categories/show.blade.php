@extends('adminlte.app')

@section('content')

<div class="inner_body">
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <strong> Show Category</strong>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            
                            
                            <div class="form-group">
                                <label class="col-sm-1 text-right"><strong>Name:</strong></label>
                                <div class="col-sm-11">
                                    {!! $Category->name !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 text-right"><strong>Created By:</strong></label>
                                <div class="col-sm-11">
                                    {!! $Category->created_by !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 text-right"><strong>Updated By:</strong></label>
                                <div class="col-sm-11">
                                    {!! $Category->updated_by !!}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection