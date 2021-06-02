@extends('home')



@section('content')
    <div class="flex justify-center">
        <div class="w-8/12  sm:w-6/12 md:w-4/12 bg-white p-6 rounded shadow my-10">
            @if(session('status'))
                <div class="mb-4 text-center text-green-500">
                    {{session('status')}}
                </div>
            @endif
            <form method="POST"  enctype="multipart/form-data" action="{{route("registerUser")}}">
                @csrf
                <div class="mb-4" >
                    <label for="firstname" class="sr-only">First Name:</label>
                    <input  type="text" name="firstname" class="bg-gray-100
                    border border-transparent  focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:border-transparent
                    w-full p-4 rounded @error('firstname') border-red-500 @enderror"
                            placeholder="First name" value="{{old('firstname')}}">

                    @error('firstname')
                    <div class="text-red-500 mt-2">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mb-4" >
                    <label for="lastname" class="sr-only">Last Name:</label>
                    <input type="text" name="lastname" class="bg-gray-100
                    border border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:border-transparent
                    w-full p-4 rounded @error('lastname') border-red-500 @enderror"
                           placeholder="Last name" value="{{old('lastname')}}">

                    @error('lastname')
                    <div class="text-red-500 mt-2">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <h3 class="w-full font-bold text-center border-b border-gray-500">Choose user roles</h3>
                    <div class="flex flex-wrap mt-2 @error('roles') border border-red-500 @enderror">
                        @foreach($roles as $role)
                            <div class="mx-1">
                                <input type="checkbox" name="roles[]" value="{{$role->id}}">
                                <label for="{{$role->id}}">{{$role->role}}</label>
                            </div>
                        @endforeach

                    </div>
                    @error('roles')
                    <div class="text-red-500 mt-2">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="address" class="sr-only">Adress:</label>
                    <input type="text" name="address" class="bg-gray-100
                    border border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:border-transparent
                    w-full p-4 rounded @error('address') border-red-500 @enderror"
                           placeholder="Address" value="{{old('address')}}">

                    @error('address')
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
                    <label for="birthday" class="sr-only">Birthday:</label>
                    <input type="text" placeholder="Birthday"  onfocus="(this.type='date')" onblur="(this.type='text')"
                           name="birthday" class="bg-gray-100
                    border border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:border-transparent
                    w-full p-4 rounded @error('birthday') border-red-500 @enderror" value="{{old('birthday')}}">
                    @error('birthday')
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
                    <label class="sr-only">User Studio</label>
                    <select name = "studio" class="bg-gray-100
                    border border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:border-transparent
                    w-full p-4 rounded">
                        <option value="0">None</option>
                        @foreach($studios as $studio)
                            <option value="{{$studio->id}}" @if(old('studio') == $studio->id) selected  @endif>{{$studio->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4" >
                    <label for="photo" class="sr-only">User Photo:</label>
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
                    <label for="password" class="sr-only">Password:</label>
                    <input type="password" name="password" class="bg-gray-100
                    border border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:border-transparent
                    w-full p-4 rounded @error('password') border-red-500 @enderror"
                           placeholder="Password">

                    @error('password')
                    <div class="text-red-500 mt-2">
                        {{$message}}
                    </div>
                    @enderror

                </div>

                <div class="mb-4" >
                    <label for="password_confirmation" class="sr-only">Password:</label>
                    <input type="password" name="password_confirmation" class="bg-gray-100
                    border border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:border-transparent
                    w-full p-4 rounded @error('password') border-red-500 @enderror"
                           placeholder="Confirm password">
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">
                        Register User
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
