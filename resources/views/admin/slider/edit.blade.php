@extends('admin.admin_master')

@section('admin')
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Create Slider</h2>
            </div>
            <div class="card-body">
                <form action="{{route('update.slider',$slider->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="old_image" value="{{$slider->image}}">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Title</label>
                        <input type="text" name="title" value="{{$slider->title}}" class="form-control" id="exampleFormControlInput1" placeholder="Slider Title">
                        @error('title')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Description</label>
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{$slider->description}}</textarea>
                        @error('description')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlFile1">Add Image</label>
                        <input type="file" name="image" value="{{$slider->image}}" class="form-control-file" id="exampleFormControlFile1">
                        @error('image')<span class="text-danger">{{$message}}</span>@enderror
                        <img src="{{asset($slider->image)}}" style="width: 200px; height: 100px;" alt="">
                    </div>

                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Update Slider</button>
                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection
