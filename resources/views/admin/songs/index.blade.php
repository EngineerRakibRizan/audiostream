@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
        @endif
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Songs') }} <a href="{{ url('admin/create-song') }}" class="btn btn-outline-primary" style="float: right;">Create Songs</a></div>
                <div class="card-body">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Title</th>
                                <th>Artist</th>
                                <th>Lyrics</th>
                                <th>youtube_link</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($songs as $key=> $song )
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $song->title }}</td>
                                <td>{{ $song->artist->name }}</td>
                                <td>{{ $song->lyrics }}</td>
                                <td>{{ $song->youtube_link }}</td>
                                <td>
                                    @if($song->status == 1)
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
                                            <li><a class="dropdown-item" href="{{ url('admin/edit-song') }}/{{ $song->id }}">Edit</a></li>
                                            <li><a class="dropdown-item" href="{{ url('admin/delete-song') }}/{{ $song->id }}">Delete</a></li> 
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