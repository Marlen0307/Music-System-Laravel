@extends('home')

@section('content')
    @foreach($users as $user)
        @if($user->id == $artist->id)
            <div class="container flex flex-wrap justify-center p-10 bg-white mx-auto mt-10" >
                <div class="w-5/12 text-center flex flex-col">
                    <img class="object-contain rounded-full" src="{{\Illuminate\Support\Facades\Storage::disk('s3')->url($user->img_src)}}">
                    <h1 class="w-full text-center font-bold text-lg">
                        {{$user->firstname . ' '. $user->lastname}}
                    </h1>
                    <p class="tracking-wider italic font-extralight text-lg">
                        @foreach($user->roles as $role) {{$role->role}} <br> @endforeach
                    </p>
                </div>
                <div class="flex flex-col w-7/12 text-center">
                    @if($user->studio_id != null)<div class="w-full text-2xl font-bold mb-5">{{$user->studio->name}}</div>@endif
                    <div class="w-full text-2xl font-bold mb-5">{{$user->birthday}}</div>
                    <div class="w-full text-2xl font-bold mb-5">{{$user->address}}</div>
                    @if($user->albums()->count())
                        <div class="w-full mb-10">
                            <h2 class="w-full border-b border-gray-400 text-lg font-bold">Albums</h2>
                            @foreach($albums as $album)
                                <div class="w-full tracking-wider italic font-extralight text-2xl">{{$album->title}}</div>
                            @endforeach
                        </div>
                    @endif
                    <div class="w-full">
                        <h2 class="w-full border-b border-gray-400 text-lg font-bold">Latest Songs</h2>
                        @foreach($songs as $song)
                            <div class="w-full flex justify-between border-b border-gray-500 tracking-wider text-gray-500">
                                <div class="w-1/12">
                                    <img src="{{\Illuminate\Support\Facades\Storage::disk('s3')->url($song->img_src)}}"
                                         class="object-contain rounded-full">
                                </div>

                                <div class="flex-grow self-center text-lg">
                                    {{$song->title}}
                                    @if($song->artists->count()>1)
                                        @foreach($song->artists as $collab)
                                            @if($collab->id != $user->id) <b> ft</b>{{' '. $collab->firstname . ' ' . $collab->lastname}}@endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>

        @endif
    @endforeach

@endsection
