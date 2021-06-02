@extends("home")

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12  sm:w-6/12 md:w-4/12 bg-white p-6 rounded shadow my-10">
            @if(session('status'))
                <div class="mb-4 text-green-500">
                    {{session('status')}}
                </div>
            @endif
            <form method="POST" action="{{route("register")}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4" >
                    <label for="firstname" class="sr-only">First Name:</label>
                    <input  type="text" name="firstname" class="bg-gray-100
                    border border-transparent  focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:border-transparent
                    w-full p-4 rounded @error('firstname') border-red-500 @enderror"
                           placeholder="Your first name" value="{{old('firstname')}}">

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
                           placeholder="Your last name" value="{{old('lastname')}}">

                    @error('lastname')
                    <div class="text-red-500 mt-2">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="photo" class="sr-only">User Photo:</label>
                    <input type="file" name="photo" class="bg-gray-100
                    border border-transparent  focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:border-transparent
                    w-full p-4 rounded">
                </div>

                <div class="mb-4">
                    <label for="address" class="sr-only">Adress:</label>
                    <input type="text" name="address" class="bg-gray-100
                    border border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:border-transparent
                    w-full p-4 rounded @error('address') border-red-500 @enderror"
                           placeholder="Your address" value="{{old('address')}}">

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
                           placeholder="Your email" value="{{old('email')}}">

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
                           placeholder="Your mobile" value="{{old('mobile')}}" >

                    @error('mobile')
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
                           placeholder="Your password">

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
                           placeholder="Confirm your password">
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">
                        Register
                    </button>
                </div>
            </form>

                <div class="mt-4">
                    <a class="block text-center w-full bg-gray-500 text-white px-4
                        py-3 rounded font-medium" href="{{route("loginForm")}}"> Log In</a>
                </div>
        </div>

    </div>
@endsection
