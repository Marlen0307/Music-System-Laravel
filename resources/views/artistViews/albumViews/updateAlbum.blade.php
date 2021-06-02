@extends('home')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12  sm:w-6/12 md:w-4/12 bg-white p-6 rounded shadow my-10">
            @if(session('status'))
                <div class="mb-4 text-center text-green-500">
                    {{session('status')}}
                </div>
            @endif
            <form method="post" action="{{route("updateAlbum", $album)}}" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="mb-4" >
                    <label for="title" class="sr-only">Album title:</label>
                    <input  type="text" name="title" class="bg-gray-100
                    border border-transparent  focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:border-transparent
                    w-full p-4 rounded @error('title') border-red-500 @enderror"
                            placeholder="Album title" value="{{$album->title}}">

                    @error('title')
                    <div class="text-red-500 mt-2">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mb-4" >
                    <label for="price" class="sr-only">Price:</label>
                    <input class="bg-gray-100 border border-transparent focus:outline-none
                        focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full p-4 rounded
                        @error('price') border-red-500 @enderror" type="number" placeholder="0.00"
                           name="price" min="0" step="0.5"
                           title="Currency"
                           pattern="^\d+(?:\.\d{1,2})?$"
                           value="{{$album->price}}">

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
                                    <input type="checkbox" @if($selectedUsers->contains($user->id)) checked @endif  name="users[]" value="{{$user->id}}">
                                    <label for="{{$user->id}}">{{$user->firstname ." ". $user->lastname}}</label>
                                @endif
                            </div>
                        @endforeach

                    </div>
                </div>

                <div class="mb-4" >
                    <label for="photo" class="sr-only">Album Cover:</label>
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

                <div class="mb-4" >
                    <label for="release_date" class="sr-only">Foundation date:</label>
                    <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')"
                           placeholder="Release date" name="release_date" class="bg-gray-100
                    border border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:border-transparent
                    w-full p-4 rounded @error('release_date') border-red-500 @enderror" value="{{$album->release_date}}">
                    @error('release_date')
                    <div class="text-red-500 mt-2">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <h3 class="w-full font-bold text-center border-b border-gray-500">Studios:</h3>
                    <div class="flex border border-transparent flex-wrap mt-2 @error('studios') border-red-500 @enderror">
                        @foreach($studios as $studio)
                            <div class="mx-1">
                                <input type="checkbox" @if($selectedStudios->contains($studio->id)) checked @endif name="studios[]" value="{{$studio->id}}">
                                <label for="{{$studio->id}}">{{$studio->name}}</label>
                            </div>
                        @endforeach

                    </div>

                    @error('studios')
                    <div class="text-red-500 mt-2">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">
                        Update Album
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
