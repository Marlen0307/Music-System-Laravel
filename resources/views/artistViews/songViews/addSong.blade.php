@extends('home')

@section('content')

    <div class="flex justify-center">
        <div class="w-8/12  sm:w-6/12 md:w-4/12 bg-white p-6 rounded shadow my-10">
            @if(session('status'))
                <div class="mb-4 text-center text-green-500">
                    {{session('status')}}
                </div>
            @endif
            <form method="post" action="{{route("addSong")}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4" >
                    <label for="title" class="sr-only">Song title:</label>
                    <input  type="text" name="title" class="bg-gray-100
                    border border-transparent  focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:border-transparent
                    w-full p-4 rounded @error('title') border-red-500 @enderror"
                            placeholder="Song title" value="{{old('title')}}">

                    @error('title')
                    <div class="text-red-500 mt-2">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                @if($albums->count())

                <div class="mb-4" >
                    <label for="title" class="sr-only">Album:</label>
                    <select  name="album" class="bg-gray-100
                    border border-transparent  focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:border-transparent
                    w-full p-4 rounded ">
                        <option value="0">Not part of an album</option>
                        @foreach($albums as $album)
                            <option value="{{$album->id}}">{{$album->title}}</option>
                        @endforeach
                    </select>
                </div>
                @endif




                <div class="mb-4" >
                    <label for="price" class="sr-only">Price:</label>
                    <input class="bg-gray-100 border border-transparent focus:outline-none
                        focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full p-4 rounded
                        @error('price') border-red-500 @enderror" type="number" placeholder="Song price"
                           name="price" min="0" step="0.1"
                           title="Currency"
                           pattern="^\d+(?:\.\d{1,2})?$"
                           value="{{old('price')}}">

                    @error('price')
                    <div class="text-red-500 mt-2">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <h3 class="w-full font-bold text-center border-b border-gray-500">Collaboration</h3>
                    <div class="flex flex-wrap mt-2">
                        @foreach($users as $user)
                            <div class="mx-1">
                                @if($user->isArtist() && auth()->user()->id != $user->id)
                                    <input type="checkbox" name="artists[]" value="{{$user->id}}">
                                    <label for="{{$user->id}}">{{$user->firstname ." ". $user->lastname}}</label>
                                @endif
                            </div>
                        @endforeach

                    </div>
                </div>

                <div class="mb-4" >
                    <label for="photo" class="sr-only">Song Cover:</label>
                    <input type="file" name="photo" class="bg-gray-100
                    border border-transparent  focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:border-transparent
                    w-full p-4 rounded @error('photo') border-red-500 @enderror">

                    @error('photo')
                    <div class="text-red-500 mt-2">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <h3 class="w-full font-bold text-center border-b border-gray-500">Songwriter/s</h3>
                    <div class="flex flex-wrap mt-2 @error('songwriters') border-red-500 @enderror">
                        @foreach($users as $user)
                            <div class="mx-1">
                                @if($user->isSongwriter())
                                    <input type="checkbox" name="songwriters[]" value="{{$user->firstname .' '. $user->lastname}}">
                                    <label for="{{$user->firstname .' '. $user->lastname}}">{{$user->firstname ." ". $user->lastname}}</label>
                                @endif
                            </div>
                        @endforeach

                            @error('songwriters')
                            <div class="text-red-500 mt-2">
                                {{$message}}
                            </div>
                            @enderror

                    </div>
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">
                        Add Song
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
