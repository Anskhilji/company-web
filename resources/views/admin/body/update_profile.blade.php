{{--{{dd($user)}}--}}
@extends('admin.admin_master')

@section('admin')
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Update Profile</h2>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{session('success')}}
                    </div>
                @endif
                <form action="{{route('update.user.profile')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="oldImage" value="{{$user->profile_photo_path}}">
                    <div class="profile-header-container">
                        <div class="profile-header-img">
                            <img class="img-circle" src="{{ $user->profile_photo_path == null ? Auth::user()->profile_photo_url : asset($user->profile_photo_path) }}" alt="{{ Auth::user()->name }}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Name</label>
                        <input type="text" class="form-control" value="{{$user->name}}" name="name" rows="3">
                        @error('name')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Email</label>
                        <input type="text" class="form-control" value="{{$user->email}}" name="email" rows="3">
                        @error('email')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Image</label>
                        <input type="file" class="form-control" value="{{$user->profile_photo_path}}" name="image" rows="3">
                    </div>

                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection
