<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <b>Edit Category</b>
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Edit category</div>
                        <div class="card-body">
                            <form action="{{route('update.category',$categories->id)}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="category">Update Category Name</label>
                                    <input type="text" class="form-control" value="{{$categories->category_name}}" name="category_name" id="" aria-describedby="helpId" placeholder="">
                                    @error('category_name')<span class="text-danger">{{$message}}</span>@enderror
                                </div>
                                <div class="form-group mt-2">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
