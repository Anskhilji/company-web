<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <b>All Category</b>
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
                        <div class="card-header">All Category</div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">SR N</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">User</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
{{--                            @php($i = 1)--}}
                            @foreach($categories as $category)
                                <tr>
                                    <th scope="row">{{$categories->firstItem()+$loop->index}}</th>
                                    <td>{{$category->category_name}}</td>
                                    <td>{{$category->user->name}}</td>

                                    <td>
                                        @if($category->created_at == null)
                                            <span class="text-danger">No date set</span>
                                        @else
                                        {{Carbon\Carbon::parse($category->created_at)->diffForHumans()}}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('category.edit',$category->id)}}" class="btn btn-info">Edit</a>
                                        <a href="{{route('category.softDelete',$category->id)}}" class="btn btn-danger">Delete</a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$categories->links()}}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add category</div>
                        <div class="card-body">
                            <form action="{{route('store.category')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="category">Category Name</label>
                                    <input type="text" class="form-control" name="category_name" id="" aria-describedby="helpId" placeholder="">
                                    @error('category_name')<span class="text-danger">{{$message}}</span>@enderror
                                </div>
                                <div class="form-group mt-2">
                                    <button type="submit" class="btn btn-primary">Add Category</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

{{--        Trashed Category Section--}}
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="crad">

                        <div class="card-header">Trash Categpry</div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">SR N</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">User</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{--                            @php($i = 1)--}}
                            @foreach($trashCat as $category)
                                <tr>
                                    <th scope="row">{{$categories->firstItem()+$loop->index}}</th>
                                    <td>{{$category->category_name}}</td>
                                    <td>{{$category->user->name}}</td>

                                    <td>
                                        @if($category->created_at == null)
                                            <span class="text-danger">No date set</span>
                                        @else
                                            {{Carbon\Carbon::parse($category->created_at)->diffForHumans()}}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('category.restore',$category->id)}}" class="btn btn-info">Restore</a>
                                        <a href="{{route('category.permanentDelete',$category->id)}}" class="btn btn-danger">P Delete</a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$trashCat->links()}}
                    </div>
                </div>

                <div class="col-md-4">

                </div>
            </div>
        </div>

    </div>
</x-app-layout>
