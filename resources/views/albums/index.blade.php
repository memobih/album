

@extends('layouts.app')
@section('content')

<body>
    <div>
        <h1 style="margin:auto;text-align:center;margin-top: 50px;font-size: 55px;">Albums</h1>
        <button onclick="AddAlbum()" style="border: 0;width: 100px;height: 30px;margin-left: 40px; background-color: green;color: white; cursor: pointer;">Add Album</button>
    </div>
    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 20px; padding: 0 50px; margin-top: 20px;">
        <div id="albmus" class="hidden">
            <div style="border:1px solid black; text-align: center;padding:10px">
                <form method="POST" action="{{route("albums.store")}}">
                    @csrf
                    <input style="padding:5px " type="text" name="name" placeholder="Album Name">
                    <input type="submit" value="add" border: 0;width: 100px;height: 30px;margin-left: 20px; background-color: green;color: white; cursor: pointer;">
                </form>
            </div>
        </div>

        @foreach ($albums as $album)
        <div style="border:1px solid black; border-top-right-radius: 10px; border-top-left-radius: 10px;text-align: center;">

            <a href="{{route('albums.show',['album'=>$album->id])}}">
            @if(empty($album->pictures->first()->image))
            <img src="{{asset('storage/image/empty.jpeg')}}" height="400" style="border-top-right-radius: 10px; border-top-left-radius: 10px; width: 100%;">
            @else
            <img src="{{asset('storage/'.$album->pictures->first()->image)}}" height="400" style="border-top-right-radius: 10px; border-top-left-radius: 10px; width: 100%;">
            @endif
        </a>
            <h1>{{$album->name}}</h1>
            <div style="margin-bottom: 20px;">
                <button  onclick="edit('edit{{$album->name}}')" style="font-size: 20px; padding : 5px 0; width: 40%;cursor: pointer;background-color: rgb(236, 236, 24);border: 0;border-radius: 5px;">Edit</button>
                <button onclick="DeleteAlbum('{{$album->id}}')" style="font-size: 20px; padding : 5px 0; width: 40%;cursor: pointer;background-color: red;border: 0;border-radius: 5px;"">Delete</button>
            </div>
            <div  id="{{"edit".$album->name}}" class="hidden" tyle="text-align: start; padding: 10px;">
                <form method="POST" action="{{route("albums.update",['album'=>$album->id])}}">
                    @csrf
                    @method('put')
                    <input style="padding:5px " type="text" name="name" placeholder="Album Name">
                    <input type="submit" value="add" border: 0;width: 100px;height: 30px;margin-left: 20px; background-color: green;color: white; cursor: pointer;">
                </form>
            </div>
            <div class="hidden" id="{{$album->id}}" style="text-align: start; padding: 10px;">
            <div>
                    <form method="post" action="{{route('albums.destroy',['album'=>$album->id])}}">
                        @csrf
                        @method('delete')
                        <div>
                            <input name="operation" value="0" type="radio" />
                            <label>Delete All Photos</label>
                        </div>
                        <div>
                            <input name="operation" id="move" onclick="dropdown('{{$album->name}}')" value="1" type="radio" />
                            <label>Move Photos To Another Album</label>
                        </div>
                        <div class="hidden" id="{{$album->name}}" id="sel">
                          <label>Distantion</label>
                         <select name="album_id" width: 50%; margin-top: 10px;font-size: 15px;">
                         <option value="">Albums</option>
                        @foreach ($albums as $nextMove )
                            <option value="{{$nextMove->id}}">{{$nextMove->name}}</option>
                        @endforeach
                               
                            </select>
                        </div>
                        <input type="submit" value="delete">
                    </form>
            </div>
        </div>
</div>
        @endforeach

    </div>


</body>
<script src="{{asset('dist/js/html.js')}}"></script>
@endsection

