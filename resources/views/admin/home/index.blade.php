@extends('admin.admin_master')

@section('admin')
    <div class="py-12">
        <div class="container">

            <div class="row">
                <h4>Home about</h4>
                <a href="{{route('add.about')}}" class="btn btn-info ml-auto mb-3">Add about</a>
                <div class="col-md-12">
                    <div class="crad">
                        @if(session()->get('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{session('success')}}</strong> You should check in on some of those fields
                                below.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-header">All About</div>
                        <table class="table">
                            <thead>
                            <tr class="d-flex">
                                <th class="col-md-1" scope="col">SR N</th>
                                <th class="col-md-1" scope="col">Title</th>
                                <th class="col-md-3" scope="col">Shot_dis</th>
                                <th class="col-md-5" scope="col">Long_dis</th>
                                <th class="col-md-2" scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($home_about as $about)
                                <tr class="d-flex">
                                    <th class="col-md-1" scope="row">{{$i++}}</th>
                                    <td class="col-md-1">{{$about->title}}</td>
                                    <td class="col-md-3">{{$about->short_dis}}</td>
                                    <td class="col-md-5">{{$about->long_dis}}</td>
{{--                                    <td class="col-md-5">{{\Carbon\Carbon::parse($about->created_at)->format('Y-m-d h:i')}}</td>--}}

                                    <td class="col-md-2">
                                        <a href="{{route('about.edit',$about->id)}}" class="btn btn-info">Edit</a>
                                        <a href="{{route('about.delete',$about->id)}}"
                                           onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
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
