@extends('home')

@section('content')
    <div class="container flex flex-wrap justify-center bg-white mx-auto mt-10" >
        <div class="w-full flex justify-center my-10">
            <div class="w-6/12 sm:w-5/12 md:3/12 lg:w-2/12">
                <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold  rounded">
                    <a class="w-full block py-2 px-4" href="{{route("addSongForm")}}">Add Song</a>
                </button>
            </div>
        </div>
        @if($songs->count())
            @foreach($songs as $song)
            <div class="w-72 mx-10 my-5 text-center flex flex-col justify-between">
                <img class="object-contain rounded-full mb-4" src="{{\Illuminate\Support\Facades\Storage::disk('s3')->url($song->img_src)}}">
                <h2 class="mb-4">
                    {{$song->title}}
                    @if($song->artists()->count()>1)
                        <span class="font-light text-sm">Featuring </span>
                        @foreach($song->artists as $artist)
                            @if($artist->id != auth()->user()->id)
                                {{' ' . $artist->firstname . ' ' . $artist->lastname . ' '}}
                            @endif
                        @endforeach
                    @endif
                </h2>
                <p class="font-bold mb-4">{{$song->price . '$'}}</p>
                @if($song->album)
                <p class="text-2xl mb-4 font-thin"> {{$song->album->title}} </p>
                @endif
                <div class="w-full flex justify-center">
                    <div class="my-2 md:my-0 md:mx-3">
                        <button class="bg-green-600 hover:bg-green-700 text-white font-bold  rounded">
                            <a class="w-full block py-2 px-4" href="{{route("updateSongForm", $song)}}">Update</a>
                        </button>
                    </div>
                    <div class="my-2 md:my-0 md:mx-3">
                        <form method="post" action="{{route("deleteSong", $song)}}">
                            @method("DELETE")
                            @csrf
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" type="submit">
                                Delete
                            </button>
                        </form>
                    </div>

                </div>
            </div>
            @endforeach
               <div class="w-full flex justify-end px-10 py-5"> {{$songs->links()}}</div>
        @endif
    </div>
@endsection
