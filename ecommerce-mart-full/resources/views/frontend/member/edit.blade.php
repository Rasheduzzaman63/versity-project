@extends('acewebv.app')

@section('content_title')
    <strong> Profile Edit</strong>
@endsection

@section('content')
    <div class="">

        <div class="row">
            <br>
            <h3>My Profile</h3>
            <form method="post" class="form-horizontal" action="{{ route('member.profile_update') }}"
                enctype="multipart/form-data">
                <div class="form-group">
                    {{ csrf_field() }}
                    <label for="" class="col-sm-2 col-form-label col-form-label-lg control-label">Name:</label>
                    <div class="col-sm-6">
                        <input type="text" name="name" class="form-control form-control-lg"
                            value="{{ $logged_member->name }}" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-form-label col-form-label-lg control-label">Photo:</label>
                    <div class="col-sm-6">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new img-thumbnail" style="width: 200px; height: 200px;">
                                <img src="{{ url($logged_member->image) }}" alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists img-thumbnail"
                                style="max-width: 200px; max-height: 200px;"></div>
                            <div>
                                <span class="btn btn-outline-secondary btn-file">
                                    <span class="fileinput-new">Select image</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input type="file" name="image" accept="image/*" />
                                </span>
                                <a href="#" class="btn btn-outline-secondary fileinput-exists"
                                    data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 col-form-label col-form-label-lg control-label">Email:</label>
                    <div class="col-sm-6">
                        <input readonly="" type="email" class="form-control form-control-lg" name="email"
                            value="{{ $logged_member->email }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 col-form-label col-form-label-lg control-label">Phone:</label>
                    <div class="col-sm-6">
                        <input type="phone" class="form-control form-control-lg" name="phone"
                            value="{{ $logged_member->phone }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 col-form-label col-form-label-lg control-label">Address:</label>
                    <div class="col-sm-6">
                        <textarea class="form-control form-control-lg" name="address" id="" cols="30" rows="2">{{ $logged_member->address }}</textarea>
                    </div>
                </div>


                <div class="form-group">
                    <label for="" class="col-sm-2 col-form-label col-form-label-lg control-label"></label>
                    <div class="col-sm-6 text-danger">
                        Passwords keep blank if you don't want to reset it.
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 col-form-label col-form-label-lg control-label">Password:</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control form-control-lg" name="password" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 col-form-label col-form-label-lg control-label">Confirm
                        Password:</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control form-control-lg" name="password_confirmation"
                            value="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-form-label col-form-label-lg control-label">.</label>
                    <div class="col-sm-2">
                        <input type="submit" class="btn btn-primary" style="width: 100%!important"
                            value="      Save      " />
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
