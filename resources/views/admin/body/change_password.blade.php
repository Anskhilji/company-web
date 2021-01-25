@extends('admin.admin_master')

@section('admin')
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Change Password</h2>
            </div>


            <div class="card-body">
                <form action="{{route('password.update')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="oldpassword" rows="3">
                        @error('oldpassword')<span class="text-danger">{{$message}}</span>@enderror
                        @if(session()->has('error'))<span class="text-danger">{{session('error')}}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">New Password</label>
                        <input type="password" id="password" class="form-control" name="password" rows="3">
                        @error('password')<span class="text-danger">{{session('error')}}</span>@endif
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" rows="3">
                        @error('password_confirmation')<span class="text-danger">{{$message}}</span>@enderror
                    </div>


                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Update Contact</button>
                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection
