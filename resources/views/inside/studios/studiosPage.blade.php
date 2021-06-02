@extends('home')

@section('content')
    <div class="container flex flex-wrap justify-center bg-white mx-auto mt-10" >
        <h1 class="text-center text-2xl w-full font-bold">Studios registered in our system</h1>
        @foreach($studios as $studio)
            <div class="w-80 mx-10 my-5 text-center  flex flex-col">
                <img class="object-contain m-auto rounded-full" src="{{\Illuminate\Support\Facades\Storage::disk('s3')->url($studio->img_src)}}">
                <h2 class="text-2xl"><a href="{{route("studioInfo", $studio)}}">{{$studio->name}}</a></h2>
                <p class="break-words  text-lg tracking-widest">{{$studio->email}}</p>
                <p class="text-lg font-bold tracking-wide">{{$studio->location}}</p>
            </div>
        @endforeach
    </div>
@endsection
