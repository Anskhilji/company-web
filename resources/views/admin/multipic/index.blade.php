@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{session('success')}}</strong> You should check in on some of those fields below.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-group">
                        @foreach($images as $multi)
                            <div class="col-md-4 mt-3">
                                <div class="card">
                                    <img src="{{asset($multi->image)}}" class="card-img-top" alt="...">
                                </div>
                            </div>
                        @endforeach
                    </div>
{{--                        {{$images->links()}}--}}

                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Multi image</div>
                        <div class="card-body">
                            <form action="{{route('multiple.image')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="brand_image">Multi Image</label>
                                    <input type="file" class="form-control" name="image[]" id="" aria-describedby="helpId" placeholder="" multiple="">
                                    @error('image')<span class="text-danger">{{$message}}</span>@enderror
                                    @error('image.*')<span class="text-danger">{{$message}}</span>@enderror
                                </div>

                                <div class="form-group mt-2">
                                    <button type="submit" class="btn btn-primary">Add Image</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
