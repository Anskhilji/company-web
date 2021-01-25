@extends('admin.admin_master')

@section('admin')
    <div class="py-12">
        <div class="container">

            <div class="row">
                <h4>Contact Page</h4>
                <a href="{{route('add.contact')}}" class="btn btn-info ml-auto mb-3">Add Contact</a>
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
                        <div class="card-header">All Contacts</div>
                        <table class="table">
                            <thead>
                            <tr class="d-flex">
                                <th class="col-md-1" scope="col">SR N</th>
                                <th class="col-md-4" scope="col">Contact Address</th>
                                <th class="col-md-2" scope="col">Contact Email</th>
                                <th class="col-md-3" scope="col">Contact phone</th>
                                <th class="col-md-2" scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($contacts as $contact)
                                <tr class="d-flex">
                                    <th class="col-md-1" scope="row">{{$i++}}</th>
                                    <td class="col-md-4">{{$contact->address}}</td>
                                    <td class="col-md-2">{{$contact->email}}</td>
                                    <td class="col-md-3">{{$contact->phone}}</td>
                                    {{--                                    <td class="col-md-5">{{\Carbon\Carbon::parse($contact->created_at)->format('Y-m-d h:i')}}</td>--}}

                                    <td class="col-md-2">
                                        <a href="{{route('contact.edit',$contact->id)}}" class="btn btn-info">Edit</a>
                                        <a href="{{route('contact.delete',$contact->id)}}"
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
