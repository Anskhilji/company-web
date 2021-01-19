<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <b>All Brand</b>
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="crad">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{session('success')}}</strong> You should check in on some of those fields below.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-header">All Brand</div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">SR N</th>
                                <th scope="col">Brand Name</th>
                                <th scope="col">Brand Image</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{--                            @php($i = 1)--}}
                            @foreach($brands as $brand)
                                <tr>
                                    <th scope="row">{{$brands->firstItem()+$loop->index}}</th>
                                    <td>{{$brand->brand_name}}</td>
                                    <td><img src="{{asset($brand->brand_image)}}" alt="" style="height: 40px; width: 70px;"></td>

                                    <td>
                                        @if($brand->created_at == null)
                                            <span class="text-danger">No date set</span>
                                        @else
                                            {{Carbon\Carbon::parse($brand->created_at)->diffForHumans()}}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('brand.edit',$brand->id)}}" class="btn btn-info">Edit</a>
                                        <a href="{{route('brand.Delete',$brand->id)}}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$brands->links()}}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add Brand</div>
                        <div class="card-body">
                            <form action="{{route('store.brand')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="brand_name">Brand Name</label>
                                    <input type="text" class="form-control" name="brand_name" id="" aria-describedby="helpId" placeholder="">
                                    @error('brand_name')<span class="text-danger">{{$message}}</span>@enderror
                                </div>

                                <div class="form-group">
                                    <label for="brand_image">Brand Image</label>
                                    <input type="file" class="form-control" name="brand_image" id="" aria-describedby="helpId" placeholder="">
                                    @error('brand_image')<span class="text-danger">{{$message}}</span>@enderror
                                </div>


                                <div class="form-group mt-2">
                                    <button type="submit" class="btn btn-primary">Add Brand</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
