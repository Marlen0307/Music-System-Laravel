@extends('home')

@section('content')
    <div class="container flex flex-wrap justify-center bg-white mx-auto mt-10" >
        <h1 class="text-center text-2xl w-full font-bold">Artists subscribed to our system</h1>
        @foreach($users as $artist)
            @if($artist->isArtist())
                <div class="w-72 mx-10 my-5 text-center flex flex-col">
                    <img class="object-contain rounded-full" src="{{\Illuminate\Support\Facades\Storage::disk('s3')->url($artist->img_src)}}">
                    <h2 class="text-lg"><a href="{{route("artistInfo", $artist)}}">{{$artist->firstname . ' ' . $artist->lastname}}</a></h2>
                    @if($artist->studio_id !=null)
                    <p class="text-lg font-bold tracking-wider">{{strtoupper($artist->studio->name)}}</p>
                    @endif
                </div>
            @endif
        @endforeach
    </div>
@endsection()
