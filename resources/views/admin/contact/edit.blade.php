@extends('admin.admin_master')

@section('admin')
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Edit Contact page</h2>
            </div>
            <div class="card-body">
                <form action="{{route('update.contact',$contacts->id)}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Contact Email</label>
                        <input type="email" class="form-control" name="email" value="{{$contacts->email}}" id="exampleFormControlTextarea1" rows="3">
                        @error('email')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Contact Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{$contacts->phone}}" id="exampleFormControlTextarea1" rows="3">
                        @error('phone')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Contact Addrees</label>
                        <textarea name="address" class="form-control" id="exampleFormControlInput1" rows="3">{{$contacts->address}}</textarea>
                        @error('address')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Update Contact</button>
                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection
