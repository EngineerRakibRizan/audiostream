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
                <div class="card-header">{{ __('Create Song') }} <a href="{{ url('admin/songs') }}" class="btn btn-outline-primary" style="float: right;">Songs</a></div>
                <div class="card-body">
                    <form action="{{ route('store.song') }}" method="post">
                        @csrf
                        <div class="form-group mt-3">
                            <label for="">Song Title<sup>*</sup></label>
                            <input type="text" placeholder="Enter Title" class="form-control @error('song_title') is-invalid @enderror" name="song_title" value="{{ old('song_title') }}" required>
                            @error('song_title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Artist</label>
                            <select name="artist_id" id="" class="form-control">
                                <option value="" hidden>Select Artist</option>
                                @foreach ($artists as $artist)
                                    <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                                @endforeach
                            </select>
                            @error('song_lyrics ')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Song Lyrics</label>
                            <textarea name="song_lyrics" id="" rows="5" class="form-control"></textarea>
                            @error('song_lyrics ')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Youtube Link<sup>*</sup></label>
                            <input type="text" placeholder="Enter Youtube Link" class="form-control @error('youtube_link') is-invalid @enderror" name="youtube_link" value="{{ old('youtube_link') }}" required>
                            @error('youtube_link')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <input type="submit" value="Submit" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection