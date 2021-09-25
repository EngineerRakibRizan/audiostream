@extends('layouts.app')

@section('content')
<style>
    sup{
        color: red;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Artist') }} <a href="{{ url('admin/artists') }}" class="btn btn-outline-primary" style="float: right;">Artists</a></div>
                <div class="card-body">
                    <form action="{{ route('update.artist') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-3">
                            <label for="">Artist Name<sup>*</sup></label>
                            <input type="text" placeholder="Enter artist name" class="form-control" name="artist_name" value="{{ $artist->name }}">
                            <input type="hidden" name="id" value="{{ $artist->id }}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Artist Image<sup>*</sup></label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                            <img src="{{ asset('uploads/artists/') }}/{{ $artist->image }}" alt="" height="40" class="mt-2">
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Artist Biography</label>
                            <textarea name="biography" id="" cols="30" rows="10" class="form-control">{{ $artist->biography }}</textarea>
                        </div>
                        <div class="form-group mt-3">
                            <input type="submit" value="Update" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection