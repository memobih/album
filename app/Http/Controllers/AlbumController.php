<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlbumRequest;
use App\Models\Album;
use Illuminate\Http\Request;
use Auth;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $albums =auth()->user()->albums;
        return view('albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlbumRequest $request)
    {
        $album = Album::create($request->validated());
        return redirect()->route('albums.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $album = Album::find($id);
        if($album->user->id==auth()->user()->id){
        $pictures = $album->pictures;
        return view('albums.show', compact('album', 'pictures'));
        } else 
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AlbumRequest $request)
    { 
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AlbumRequest $request, string $id)
    {
        $album = Album::find($id);
        if($album->user->id==auth()->user()->id){
        $album->update($request->validated());
        }
        return redirect()->back();
    }

    public function destroy(Request $request, string $id)
    {
        $album = Album::find($id);
        if($album->user->id==auth()->user()->id){
        $pictures = $album->pictures;
        $operation = $request->operation;
        if ($operation == "1") {                   // moving 
            $move = $request->validate([
                'album_id' => 'required|exists:albums,id'
            ]);
            if ($move['album_id']== $id) return redirect()->back();
            foreach ($pictures as $picture) {
                $picture->update($move);
            }
            $album->delete();
        } 
        else {                                    //deleted
            foreach ($pictures as $picture) {
                $picture->forceDelete();
            }
            $album->delete();
        }
    }
        return redirect()->back();
    }
}
