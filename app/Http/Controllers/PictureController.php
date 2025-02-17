<?php

namespace App\Http\Controllers;

use App\Http\Requests\PictureRequest;
use App\Models\Album;
use App\Models\Picture;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */ public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PictureRequest $request)
    {
        $album=Album::find($request->album_id);
        if($album->user->id==auth()->user()->id){
      $picture=Picture::create($request->validated());
        }
      return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    
    {
        $picture=Picture::find($id); 
        if($picture->album->user->id==auth()->user()->id){
        if($picture)
        $picture->delete();
        }
        return redirect()->back();
    } 
    public function restore(string $id) { 
        $picture=Picture::find($id); 
        if($picture->album->user->id==auth()->user()->id){
        $picture->restore();
        }
        return redirect()->back();
    } 
    public function forceDelete(string $id){ 
       $picture=Picture::find($id); 
       if($picture->album->user->id==auth()->user()->id){
       $picture->forceDelete();
       }
       return redirect()->back();
    }
    
}
