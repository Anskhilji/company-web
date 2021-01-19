<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <b>Edit Brand</b>
        </h2>

    </x-slot>

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
                    <div class="card">
                        <div class="card-header">Edit Brand</div>
                        <div class="card-body">
                            <form action="{{route('update.brand',$brands->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="old_image" value="{{$brands->brand_image}}">
                                <div class="form-group">
                                    <label for="brand_name">Update Brad Name</label>
                                    <input type="text" class="form-control" value="{{$brands->brand_name}}" name="brand_name" id="" aria-describedby="helpId" placeholder="">
                                    @error('brand_name')<span class="text-danger">{{$message}}</span>@enderror
                                </div>

                                <div class="form-group">
                                    <label for="brand_image">Update Brad Name</label>
                                    <input type="file" class="form-control" value="{{$brands->brand_image}}" name="brand_image" id="" aria-describedby="helpId" placeholder="">
                                    @error('brand_image')<span class="text-danger">{{$message}}</span>@enderror
                                    <div class="form-group">
                                        <img src="{{asset($brands->brand_image)}}" style="width: 400px; height: 200px;" alt="">
                                    </div>
                                </div>


                                <div class="form-group mt-2">
                                    <button type="submit" class="btn btn-primary">Update Brand</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
