@extends('admin.admin_master')

@section('admin')
    <div class="py-12">
    <div class="container">

            <div class="row">
                <h4>Home slider</h4>
                    <a href="{{route('add.slider')}}" class="btn btn-info ml-auto mb-3">Add slider</a>
                <div class="col-md-12">
                    <div class="crad">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{session('success')}}</strong> You should check in on some of those fields below.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-header">All Slider</div>
                        <table class="table">
                            <thead>
                            <tr class="d-flex">
                                <th class="col-md-1" scope="col">SR N</th>
                                <th class="col-md-1" scope="col">Title</th>
                                <th class="col-md-6" scope="col">Description</th>
                                <th class="col-md-2" scope="col">Image</th>
                                <th class="col-md-2"scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($sliders as $slider)
                                <tr class="d-flex">
                                    <th class="col-md-1" scope="row">{{$i++}}</th>
                                    <td class="col-md-1" >{{$slider->title}}</td>
                                    <td class="col-md-6">{{$slider->description}}</td>
                                    <td class="col-md-2"> <img src="{{asset($slider->image)}}" alt="" style="height: 40px; width: 70px;"></td>

                                    <td class="col-md-2">
                                        <a href="{{route('slider.edit',$slider->id)}}" class="btn btn-info">Edit</a>
                                        <a href="{{route('delete.slider',$slider->id)}}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
