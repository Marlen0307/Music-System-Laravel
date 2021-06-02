@extends('home')

@section('content')
    <div class="md:container flex flex-wrap bg-white mx-auto mt-10" >
        <div class="w-full flex justify-center my-10">
            <div class="w-6/12 sm:w-5/12 md:3/12 lg:w-2/12">
                <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold  rounded">
                    <a class="w-full block py-2 px-4" href="{{route("addStudioForm")}}">Add Studio</a>
                </button>
            </div>
        </div>
        @if($studios->count())
            @foreach($studios as $studio)
                <div class="w-80 mx-10 my-5 text-center  flex flex-col">
                    <img class="object-contain m-auto rounded-full" src="{{\Illuminate\Support\Facades\Storage::disk('s3')->url($studio->img_src)}}">
                    <h2 class="text-2xl"><a href="{{route("studioInfo", $studio)}}">{{$studio->name}}</a></h2>
                    <p class="break-words  text-lg tracking-widest">{{$studio->email}}</p>
                    <p class="text-lg font-bold tracking-wide">{{$studio->location}}</p>
                    <p>{{$studio->mobile}}</p>
                    <div class="flex justify-center">
                        <div class="mx-3">
                            <button class="bg-green-600 hover:bg-green-700 text-white font-bold  rounded">
                                <a class="w-full block py-2 px-4" href="{{route("updateStudioForm", $studio)}}">Update</a>
                            </button>
                        </div>
                        <div class="mx-3">
                            <form method = "post" action ="{{route("deleteStudio", $studio)}}">
                                @csrf
                                @method("DELETE")
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                        type="submit">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center font-bold flex-grow">There are no studios registered in the system</div>
        @endif

    </div>
@endsection
