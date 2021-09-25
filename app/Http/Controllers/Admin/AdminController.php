<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Artist;
use App\Models\Song;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function dashboard() 
  {
    $title = 'Admin Dashboard';

    return view('admin.dashboard', compact('title'));
  }
  

  //artists
  public function artists()
  {
    $artists = Artist::latest()->get();
    return view('admin.artists.index', compact('artists'));
  }

  public function create_artist()
  { 
    return view('admin.artists.create');
  }

  public function store_artist(Request $request)
  {

    // validate data
    $validated = $request->validate([
        'artist_name' => 'required',
        'image'       => 'required',
    ]);

    // create slug
    $slug = Str::slug($request->artist_name, '-');

    // check slug exist or not 
    $exist_artist_by_slug = Artist::where('slug', $slug)->count();

    // if slug exist then add a random number in new slug
    if($exist_artist_by_slug > 0){
      $slug = $slug.'-'.rand(1, 100);
    }

    $file_name = $slug.'.'.$request->image->extension();

    $request->image->move(public_path().'/uploads/artists/', $file_name);  
  
    // store data
    Artist::create([
      'name' => $request->artist_name,
      'slug'  => $slug,
      'image' => $file_name,
      'biography' => $request->biography
    ]);

    // return to artists page after store 
    return redirect('admin/artists')->with('msg', 'Artist Saved Successfully');
    
  }

  public function edit_artist($id)
  {
    $artist = Artist::find($id);
    return view('admin.artists.edit', compact('artist'));
  }

  public function update_artist(Request $request)
  {
    $id = $request->id;
    $artist = Artist::find($id); 

    // create slug
    $slug = Str::slug($request->artist_name, '-');

    // check slug exist or not 
    $exist_artist_by_slug = Artist::where('slug', $slug)->where('id', '!=', $id)->count();

    // if slug exist then add a random number in new slug
    if($exist_artist_by_slug > 0){
      $slug = $slug.'-'.rand(1, 100);
    }


    if($request->hasFile('image')){ 
      $image_path = public_path('/uploads/artists/'.$artist->image);  // prev image path
      if(File::exists($image_path)) {
          File::delete($image_path);
      }
      $file_name = $slug.'.'.$request->image->extension(); 
      $request->image->move(public_path().'/uploads/artists/', $file_name);  
    }else{
      $file = $artist->image;
    } 

    Artist::where('id', $id)->update([
      'name'        => $request->artist_name,
      'slug'        => $slug,
      'image'       => $file_name,
      'biography'   => $request->biography
    ]);
    
    // return to artists page after update 
    return redirect('admin/artists')->with('msg', 'Artist Updated Successfully');
  }

  public function delete_artist($id){
    Artist::where('id', $id)->delete();
    // return to artists page after Deleted 
    return redirect('admin/artists')->with('msg', 'Artist Deleted Successfully');
  }



    //artists
    public function songs()
    {
      $songs = Song::latest()->with('artist')->get();
      return view('admin.songs.index', compact('songs'));
    }
    public function create_song()
    { 
      $artists = Artist::get();
      return view('admin.songs.create',compact('artists'));
    }
    public function store_song(Request $request)
    {
  
      // validate data
      $validated = $request->validate([
          'song_title' => 'required',
          'artist_id' => 'required',
          'song_lyrics'       => 'required',
          'youtube_link'       => 'required',
      ]);

      $user_id = Auth::user()->id;
  
      // store data
      Song::create([
        'user_id' => $user_id,
        'artist_id' => $request->artist_id,
        'title' => $request->song_title,
        'lyrics' => $request->song_lyrics,
        'youtube_link' => $request->youtube_link
      ]);
  
      // return to songs page after store 
      return redirect('admin/songs')->with('msg', 'Song Saved Successfully');
      
    }
    public function edit_song($id)
    {
      $song = Song::find($id);
      $artists = Artist::get();
      return view('admin.songs.edit', compact('song','artists'));
    }
    public function update_song(Request $request)
    {
      $id = $request->id;
  
      Song::where('id', $id)->update([
        'artist_id' => $request->artist_id,
        'title' => $request->song_title,
        'lyrics' => $request->song_lyrics,
        'youtube_link' => $request->youtube_link
      ]);
      
      // return to songs page after update 
      return redirect('admin/songs')->with('msg', 'Song Updated Successfully');
    }
    public function delete_song($id)
    {
      Song::where('id', $id)->delete();
      // return to songs page after Deleted 
      return redirect('admin/songs')->with('msg', 'Songs Deleted Successfully');
    }

    public function view_songs($id){
      $artists = Artist::with('songs')->find($id);
      return view('admin.artists.songs', compact('artists'));
    }
}
