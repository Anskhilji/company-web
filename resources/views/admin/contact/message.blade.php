@extends('admin.admin_master')

@section('admin')
    <div class="py-12">
        <div class="container">

            <div class="row">
                <h4>Admin Message</h4>
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
                        <div class="card-header">All Admin Message</div>
                        <table class="table">
                            <thead>
                            <tr class="d-flex">
                                <th class="col-md-1" scope="col">SR N</th>
                                <th class="col-md-3" scope="col">Name</th>
                                <th class="col-md-2" scope="col">Email</th>
                                <th class="col-md-2" scope="col">Subject</th>
                                <th class="col-md-3" scope="col">Message</th>
                                <th class="col-md-1" scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($messages as $message)
                                <tr class="d-flex">
                                    <th class="col-md-1" scope="row">{{$messages->firstItem()+$loop->index}}</th>
                                    <td class="col-md-2">{{$message->name}}</td>
                                    <td class="col-md-2">{{$message->email}}</td>
                                    <td class="col-md-2">{{$message->subject}}</td>
                                    <td class="col-md-3">{{$message->message}}</td>
                                    {{--                                    <td class="col-md-5">{{\Carbon\Carbon::parse($message->created_at)->format('Y-m-d h:i')}}</td>--}}

                                    <td class="col-md-1">
                                        <a href="{{route('message.delete',$message->id)}}"
                                           onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{$messages->onEachSide(1)->links()}}
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
