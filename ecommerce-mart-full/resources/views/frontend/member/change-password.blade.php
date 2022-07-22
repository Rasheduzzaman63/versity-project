@extends('frontend.layouts.member-app')
@section('content')
    <br />
    <form method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                Change Password
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <label>New Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            required="" />
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <label>Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required="" />
                    </div>
                    <div class="col-sm-4" style="padding-top: 25px;">
                        <button type="submit" class="btn btn-sm btn-info">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection
