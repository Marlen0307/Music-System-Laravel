
@extends('home')

@section('content')
    <div class="container flex flex-wrap justify-center bg-white mx-auto mt-10" >

        <div class="w-full flex justify-center mt-10">
            <div class="w-6/12 sm:w-5/12 md:3/12 lg:w-2/12">
                <button class="w-full  bg-blue-500 mx-auto hover:bg-blue-700 text-white font-bold rounded">
                    <a class="w-full block py-2 px-4" href="{{route("addUserForm")}}">Add User</a>
                </button>
            </div>
        </div>
            @if($users->count())

            @foreach($users as $user)
                <div class="w-72 mx-10 my-5 text-center flex flex-col">
                    @if($user->img_src!= null)
                    <img class="object-contain rounded-full mb-4" src="{{\Illuminate\Support\Facades\Storage::disk('s3')->url($user->img_src)}}">
                    @else
                        <img class="object-contain rounded-full mb-4" src="{{\Illuminate\Support\Facades\Storage::disk('s3')->url("images/avatar-1577909_960_720.png")}}">
                    @endif
                    <h2 class="text-lg mb-4">{{$user->firstname . ' ' . $user->lastname}}</h2>
                    <p class="font-light tracking-wider mb-4">{{$user->email}}</p>
                    <p class="mb-4">{{$user->mobile}}</p>
                    <div class="flex justify-center mb-4">
                        <div class="my-2 md:mx-3 md:my-0">
                            <button class="bg-green-600 hover:bg-green-700 text-white font-bold  rounded">
                                <a class="w-full block py-2 px-4" href="{{route("updateUserForm", $user)}}">Update</a>
                            </button>
                        </div>

                        <div class="my-2 md:my-0 md:mx-3">
                            <form method="post" action="{{route("deleteUser", $user)}}">
                                @method("DELETE")
                                @csrf
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                        type="submit">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
                <div class="w-full flex justify-end px-10">{{$users->links()}}</div>

            @else
            <div class="text-center font-bold flex-grow">There are no users registered in the system</div>
            @endif

    </div>
@endsection
