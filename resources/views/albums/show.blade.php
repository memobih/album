<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('dist/css/html.css')}}">
    <title>Photos</title>
</head>

<body>
    <div>
        <h1 style="margin:auto;text-align:center;margin-top: 50px;font-size: 55px;">Photos</h1>
        <button onclick="AddPhoto()" style="border: 0;width: 100px;height: 30px;margin-left: 40px; background-color: green;color: white; cursor: pointer;">Add Photo</button>
    </div>
    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 20px; padding: 0 50px; margin-top: 20px;">
        <div id="photos" class="hidden">
            <form action="{{route('pictures.store')}}" method="post" enctype="multipart/form-data">
              @csrf
            <div style="border:1px solid black; text-align: center;padding:10px">
                <h1>Add Photo</h1><input style="padding:5px" name="name" type="text" placeholder="Photo Name">
                <input style="padding:5px" name="album_id" value="{{$album->id}}" type="text"  hidden>
                <input name="image" style="margin-top:20px;margin-bottom:20px;margin-left:80px" type="file" />
                <input type ="submit" value="Add" style="border: 0;width: 100px;height: 30px; background-color: green;color: white; cursor: pointer;">
            </div>
            </form>
        </div>
        @foreach ($pictures as $picture )
        <div style="border:1px solid black; border-top-right-radius: 10px; border-top-left-radius: 10px;text-align: center;">
      
            <img src="{{asset('storage/'.$picture->image)}}" height="400" style="border-top-right-radius: 10px; border-top-left-radius: 10px; width: 100%;">
            <h1>{{$picture->name}}</h1>
            <div style="margin-bottom: 20px;">
            <form method="post" action="{{route('pictures.destroy',['picture'=>$picture->id])}}">
           @csrf
        @method('delete')
        <input type="submit" value="Delete" style="font-size: 20px; padding : 5px 0; width: 40%;cursor: pointer;background-color: red;border: 0;border-radius: 5px;">

     </form>
            </div>
        </div>
        @endforeach
       

</body>
<script src=" {{asset('dist/js/html.js')}}"></script>

</html>