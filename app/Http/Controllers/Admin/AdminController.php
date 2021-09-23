<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Artist;
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

    $file = $request->file('image')->store('public/uploads/artists');

    // store data
    Artist::create([
      'name' => $request->artist_name,
      'slug'  => $slug,
      'image' => $file,
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
    if($request->hasFile('image')){ 
      $image_path = public_path('storage/app/'.$artist->image);  // prev image path
      if(File::exists($image_path)) {
          File::delete($image_path);
      }
      $file = $request->file('image')->store('public/uploads/artists');
    }else{
      $file = $artist->image;
    }  

    // create slug
    $slug = Str::slug($request->artist_name, '-');

    // check slug exist or not 
    $exist_artist_by_slug = Artist::where('slug', $slug)->where('id', '!=', $id)->count();

    // if slug exist then add a random number in new slug
    if($exist_artist_by_slug > 0){
      $slug = $slug.'-'.rand(1, 100);
    }

    Artist::where('id', $id)->update([
      'name'      => $request->artist_name,
      'slug'      => $slug,
      'image'      => $file,
      'biography' => $request->biography
    ]);
    
    // return to artists page after update 
    return redirect('admin/artists')->with('msg', 'Artist Updated Successfully');
  }

  public function delete_artist($id){
    Artist::where('id', $id)->delete();
    // return to artists page after Deleted 
    return redirect('admin/artists')->with('msg', 'Artist Deleted Successfully');
  }
}
