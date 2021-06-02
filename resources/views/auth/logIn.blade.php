@extends("home")

@section("content")
    <div class="flex justify-center align-middle">
        <div class=" w-8/12  sm:w-6/12 md:w-4/12 bg-white p-6 rounded shadow my-10">
            @if(session('status'))
                <div class="mb-4 text-red-500 text-center">
                    {{session('status')}}
                </div>
            @endif

            <form method="post" action="{{route("login")}}">
                @csrf

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

                <div class="mb-4 text-center items-center">
                    <input type="checkbox" id="remember" name="remember" class="mr-2">
                    <label for = "remember">Remember me</label>
                </div>

                <div class="mb-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">
                        Log In
                    </button>
                </div>

                <div class="text-gray-500 text-center">
                    Don't yet have an account? <a href="{{route("signUpForm")}}" class="text-blue-500">Sign Up</a>
                </div>

            </form>
        </div>
    <div>
@endsection()

