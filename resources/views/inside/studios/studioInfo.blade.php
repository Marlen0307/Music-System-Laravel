@extends('home')

@section('content')
    <div class="container flex flex-col md:flex-row justify-center mx-auto p-10 bg-white mt-10" >
        <div class="w-5/12 text-center flex flex-col mx-auto">
            <img class="object-contain rounded-full" src="{{\Illuminate\Support\Facades\Storage::disk('s3')->url($studio->img_src)}}">
            <h1 class="w-full text-center font-bold text-2xl">
                {{$studio->name}}
            </h1>
            <p class="tracking-widest font-bold italic font-extralight text-lg">
                {{$studio->email}}
            </p>
            <p class="tracking-wide italic font-extralight text-lg">
                {{$studio->mobile}}
            </p>
            <p class="tracking-wider font-extralight text-lg">
                {{$studio->location}}
            </p>
        </div>
        <div class="flex flex-col w-7/12 text-center justify-center mx-auto">
            <div class="w-full mb-10">
                <h2 class="w-full border-b border-gray-400 text-lg font-bold">Studio Genres</h2>
                <div class="md:w-6/12 mx-auto">
                    @foreach($genres as $genre)
                        <div class="mx-5 tracking-wider inline text-gray-500 text-xl">{{$genre->genre}}</div>
                    @endforeach
                </div>
            </div>
            <div class="w-full">
                <h2 class="w-full border-b border-gray-400 text-lg font-bold">Studio People</h2>
                <div>
                    @foreach($users as $user)
                            <div class="md:mx-5 mb-5 flex-wrap md:inline text-gray-500">
                                <img class="object-contain inline w-1/12 h-1/12 rounded-full" src="{{\Illuminate\Support\Facades\Storage::disk('s3')->url($user->img_src)}}">
                                <span class="align-middle" >{{$user->firstname . ' ' . $user->lastname}}</span>
                            </div>
                    @endforeach
                </div>

            </div>
            <div class="w-full">
                <h2 class="w-full border-b border-gray-400 text-lg font-bold">Studio Albums</h2>
                <div>
                    @foreach($albums as $album)
                            <div class="md:mx-5 mb-5 flex-wrap md:inline text-gray-500">
                                <img class="object-contain inline w-1/12 h-1/12 rounded-full" src="{{\Illuminate\Support\Facades\Storage::disk('s3')->url($album->img_src)}}">
                                <span class="align-middle text-lg font-bold" >{{$album->title . ' '}}</span>
                            </div>
                    @endforeach
                </div>

            </div>
            </div>

        </div>
    </div>
@endsection
