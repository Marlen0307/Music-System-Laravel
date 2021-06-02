@extends('home')

@section('content')
    <div class="container flex flex-col md:flex-row justify-center p-10 bg-white mx-auto mt-10" >
        <div class="w-10/12 md:w-5/12 text-center flex flex-col">
            <img class="object-fill rounded-full" src="{{\Illuminate\Support\Facades\Storage::disk('s3')->url($album->img_src)}}">
            <h1 class="w-full text-center font-bold text-lg">
                {{$album->title}}
            </h1>
            <p class="tracking-wider italic font-extralight text-lg">
                @foreach($artists as $artist) {{$artist->firstname . ' '. $artist->lastname}} <br> @endforeach
            </p>
            <p>
                @foreach($studios as $studio) {{$studio->name}} <br> @endforeach
            </p>
            <p class="mt-4">
                @if($rate > 0 )<b>Audience Rating: </b>{{round(' '.$rate,2)}}@endif
            </p>
        </div>
        <div class="flex flex-col md:w-7/12 pl-5 text-center">
            <div class="w-full flex flex-wrap font-bold text-lg justify-between border-b border-gray-400 ">
                <div class="w-3/12 text-left">Song</div>
                <div class="w-3/12">Artists</div>
                <div class="w-3/12">Written by</div>
            </div>
            @foreach($songs as $song)
                <div class="w-full mt-2 flex flex-wrap justify-between border-b border-gray-500">
                    <div class="w-3/12 text-left">
                        <img class="object-contain inline w-2/12 h-2/12 rounded-full" src="{{\Illuminate\Support\Facades\Storage::disk('s3')->url($song->img_src)}}">
                        <span>{{$song->title}}</span>
                    </div>
                     <div class="w-3/12">
                         @foreach($song->artists as $artist)
                             {{$artist->firstname . ' ' . $artist->lastname}}
                         @endforeach
                     </div>
                    <div class="w-3/12">
                        @foreach($song->songwriters as $songwriter)
                            {{$songwriter->songwriter}}
                        @endforeach
                    </div>
                </div>
            @endforeach
            {{$songs->links()}}

            <div class="mt-5 flex flex-col">
                <div class="w-full">
                    @foreach($comments as $comment)
                        <div class="w-full p-5">
                            <div class="text-left">
                                <span class="text-lg font-bold">{{$comment->user->firstname . ' ' . $comment->user->lastname}}</span>
                                <span class="text-sm text-gray-600">{{$comment->created_at->diffForHumans()}}</span>
                            </div>
                            <p class="text-left pl-20">{{$comment->comment}}</p>
                            @if($comment->user->id == auth()->user()->id)
                                <div class="flex pl-20 w-full">
                                <form method="post" class="inline" action="{{route("deleteComment", $comment)}}">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="inline">
                                        <a class="text-red-500">Delete</a>
                                    </button>
                                </form>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="w-full flex flex-wrap">
                    <form method="post" class="w-full" action="{{route("addCommentandRate", $album)}}">
                        @csrf
                        <div class="w-full md:w-6/12 md:inline m-5">
                            <label for="rate" class="sr-only">Rate this album</label>
                            <select name="rate" class="w-full md:w-auto bg-gray-100
                                border border-transparent  focus:outline-none focus:ring-2 focus:ring-blue-500
                                focus:border-transparent p-4 rounded">
                                <option class="text-center" value="0">Rate this album</option>
                                <option value="1">1</option>
                                <option value="2">3</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>

                        <div class="w-full md:w-6/12 md:inline m-5">
                            <label class="sr-only" for="comment">Add a comment:</label>
                            <input autocomplete="off" class="w-full md:w-auto bg-gray-100
                    border border-transparent  focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:border-transparent p-4 rounded" placeholder="Leave a comment" name="comment" >
                        </div>

                        <div class="md:inline">
                            <button type="submit"class="bg-blue-500 text-white px-4 py-3 rounded font-medium">
                                Add
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
