@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
        @endif
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Artists') }} <a href="{{ url('admin/create-artist') }}" class="btn btn-outline-primary" style="float: right;">Create Artist</a></div>
                <div class="card-body">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($artists as $key=> $artist )
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $artist->name }}</td>
                                <td>{{ $artist->slug }}</td>
                                <td>
                                    <img src="{{ env('APP_URL') }}/storage/app/{{ $artist->image }}" alt="" height="40">
                                </td>
                                <td>
                                    @if($artist->status == 1)
                                    <span class="badge bg-success">Active</span>
                                    @else
                                    <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-danger dropdown-toggle text-white" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                           Action
                                        </a>

                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <li><a class="dropdown-item" href="{{ url('admin/edit-artist') }}/{{ $artist->id }}">Edit</a></li>
                                            <li><a class="dropdown-item" href="{{ url('admin/delete-artist') }}/{{ $artist->id }}">Delete</a></li> 
                                        </ul>
                                    </div>
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