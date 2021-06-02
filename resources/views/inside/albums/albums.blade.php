@extends('home')

@section('content')
    <div class="container flex flex-wrap justify-center bg-white mx-auto mt-10" >
        <h1 class="text-center text-2xl w-full font-bold">Albums of our artists</h1>
        @foreach($albums as $album)
            <div class="w-80 mx-10 my-5 text-center  flex flex-col">
                <img class="object-contain m-auto rounded-full" src="{{\Illuminate\Support\Facades\Storage::disk('s3')->url($album->img_src)}}">
                <h2 class="text-2xl"><a href="{{route("albumInfo", $album)}}">{{$album->title}}</a></h2>
                <p class="break-words  text-lg tracking-wide">
                   @foreach($album->artists as $artist) {{$artist->firstname . ' ' . $artist->lastname}} <br> @endforeach
                </p>
                <p class="text-lg font-bold tracking-wide mt-5">
                    @foreach($album->studios as $studio) {{$studio->name}} <br>@endforeach
                </p>
            </div>
        @endforeach
    </div>
@endsection
