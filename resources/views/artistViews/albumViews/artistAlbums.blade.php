@extends('home')

@section('content')
    <div class="container flex flex-wrap justify-center bg-white mx-auto mt-10" >
        <div class="w-full flex justify-center my-10">
            <div class="w-6/12 sm:w-5/12 md:3/12 lg:w-2/12">
                <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold  rounded">
                    <a class="w-full block py-2 px-4" href="{{route("addAlbum")}}">Add Album</a>
                </button>
            </div>
        </div>
        @if($albums->count())
            @foreach($albums as $album)
                <div class="w-80 mx-10 my-5 text-center flex flex-col justify-between">
                    <img class="object-contain rounded-full" src="{{\Illuminate\Support\Facades\Storage::disk('s3')->url($album->img_src)}}">
                    <h2 class="text-2xl">{{$album->title}}</h2>
                    <p class="break-words  text-lg tracking-wide">
                        @foreach($album->artists as $artist)
                           @if($artist->id != auth()->user()->id) {{$artist->firstname . ' ' . $artist->lastname}} <br> @endif
                        @endforeach
                    </p>
                    <p class="font-bold">
                        {{$album->release_date}}
                    </p>
                    <p class="text-lg font-bold tracking-wide mt-5">
                        @foreach($album->studios as $studio) {{$studio->name}} <br>@endforeach
                    </p>
                    <div class="w-full flex justify-center ">
                        <div class="mx-2">
                            <button class="bg-green-600 hover:bg-green-700 text-white font-bold  rounded">
                                <a class="w-full block py-2 px-4" href="{{route("updateAlbumForm", $album)}}">Update</a>
                            </button>
                        </div>
                        <div class="mx-2">
                            <form method="post" action="{{route("deleteAlbum", $album)}}">
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
        @endif
    </div>
@endsection
