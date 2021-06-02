@extends('home')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12  sm:w-6/12 md:w-4/12 bg-white p-6 rounded shadow my-10">
            @if(session('status'))
                <div class="mb-4 text-center text-green-500">
                    {{session('status')}}
                </div>
            @endif
            <form method="post" action="{{route("registerStudio")}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4" >
                    <label for="name" class="sr-only">Studio Name:</label>
                    <input  type="text" name="name" class="bg-gray-100
                    border border-transparent  focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:border-transparent
                    w-full p-4 rounded @error('name') border-red-500 @enderror"
                            placeholder="Studio name" value="{{old('name')}}">

                    @error('name')
                    <div class="text-red-500 mt-2">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mb-4" >
                    <label for="photo" class="sr-only">Studio Photo:</label>
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
                    <label for="location" class="sr-only">Location:</label>
                    <input  type="text" name="location" class="bg-gray-100
                    border border-transparent  focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:border-transparent
                    w-full p-4 rounded @error('location') border-red-500 @enderror"
                            placeholder="Location" value="{{old('location')}}">

                    @error('location')
                    <div class="text-red-500 mt-2">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mb-4" >
                    <label for="email" class="sr-only">Email:</label>
                    <input type="email" name="email" class="bg-gray-100
                    border border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:border-transparent
                    w-full p-4 rounded @error('email') border-red-500 @enderror"
                           placeholder="Email" value="{{old('email')}}">

                    @error('email')
                    <div class="text-red-500 mt-2">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mb-4" >
                    <label for="found_date" class="sr-only">Foundation date:</label>
                    <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')"
                           placeholder="Foundation date" name="found_date" class="bg-gray-100
                    border border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:border-transparent
                    w-full p-4 rounded @error('found_date') border-red-500 @enderror" value="{{old('found_date')}}">
                    @error('found_date')
                    <div class="text-red-500 mt-2">
                        {{$message}}
                    </div>
                    @enderror
                </div>


                <div class="mb-4" >
                    <label for="mobile" class="sr-only">Mobile:</label>
                   <input type="text" name="mobile" class="bg-gray-100
                    border border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:border-transparent
                    w-full p-4 rounded @error('mobile') border-red-500 @enderror"
                           placeholder="Mobile" value="{{old('mobile')}}" >

                    @error('mobile')
                    <div class="text-red-500 mt-2">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <h3 class="w-full font-bold text-center border-b border-gray-500">Choose studio genres</h3>
                    <div class="flex flex-wrap mt-2 @error('genres') border border-red-500 @enderror">
                        @foreach($genres as $genre)
                            <div class="mx-1">
                                <input type="checkbox" name="genres[]" value="{{$genre->id}}">
                                <label for="{{$genre->id}}">{{$genre->genre}}</label>
                            </div>
                        @endforeach

                    </div>
                    @error('genres')
                    <div class="text-red-500 mt-2">
                        {{$message}}
                    </div>
                    @enderror
                </div>


                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">
                        Register Studio
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
