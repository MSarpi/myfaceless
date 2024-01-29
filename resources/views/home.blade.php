@extends('layouts.app')

@section('tittle')
    - {{__('traslate.page.home')}}
@endsection

@section('titulo')
    @auth
        pagina Principal
    @endauth
    @guest
        
    @endguest
@endsection

@section('contenido')
    @auth
        @if ($posts->count())
            {{-- @foreach ($posts as $post) --}}
                <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                    @foreach($posts as $post)
                    <div class="p-5 bg-comentary shadow-2xl rounded-md">
                        <div class="flex items-center mb-3">
                            @if ($post->user->imagen_perfil == "")
                                <img class="rounded-full w-16 h-16 border-style" src="{{ asset('img/usuario.svg') }}" >
                            @else 
                                <img class="rounded-full w-16 h-16 object-cover object-top border-style" src="{{ asset('perfiles/' . $post->user->imagen_perfil) }}" >
                            @endif
                            <span class="ml-4 items-center text-2xl">{{$post->user->username}}</span>
                        </div>
                        <div class="relative overflow-hidden aspect-square group transition-transform transform hover:scale-103">
                            <a href="{{ route('post.show', ['post' => $post, 'user' => $post->user]) }}">
                                <img class="object-cover object-top w-full h-full" src="{{ asset('upload') . '/' . $post->imagen }}" alt="img_post">
                            </a>
                        </div>
                    </div>

                    @endforeach
                </div>
                {{-- <p>{{$post->user}}</p>
                <p>{{$post}}</p>
                <br>
            @endforeach --}}
            
            @else
                <p>no hay</p>
        @endif
    @endauth
    @guest
    <div class="md:flex md:justify-center md:items-center">
        <div class="md:w-6/12"> 
            <img class="img_login_1" width="80%" src="{{asset('img/peep-sitting-9.png')}}" alt="imagen login">
        </div>
        <div class="md:w-5/12 bg-comentary p-6 rounded-lg shadow-lg border">
            <p class="text-4xl text-center font-bold color-comentari">Devstagram</p>
            <br>
            <hr>
            <br>
            <form action="{{route('login')}}" method="POST" novalidate>
                @csrf
                @if (session('mensaje'))
                <p class="text-red-700">{{ session('mensaje') }}</p>
                @endif
                <div class="relative mb-3">
                    <input type="email" id="email" name="email" type="text" class="block rounded-t-lg px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " 
                    value="{{ old('email')}}"/>
                    @error('email')
                    <p class="text-red-700">{{ $message }}</p>
                    @enderror
                    <label for="email" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">{{__('traslate.loginpage.mail')}}</label>
                </div>
    
                <div class="relative mb-3">
                    <input type="password" id="password" name="password" type="text" class="block rounded-t-lg px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " 
                    />
                    @error('password')
                    <p class="text-red-700">{{ $message }}</p>
                    @enderror
                    <label for="password" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">{{__('traslate.loginpage.password')}}</label>
                </div>
    
                <div class="mb-5">
                    <input type="checkbox" name=remember><label class="color-comentari text-sm"> {{ __('traslate.loginpage.sesion')}}</label>
                </div>
    
                <input type="submit"
                value="{{ __('traslate.loginpage.login')}}"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
            <br>
            <p class="text-center font-bold">{{__('traslate.loginpage.count')}}<span><a class="text-blue-500 hover:text-blue-800" href="{{route('registro')}}"> {{__('traslate.loginpage.register')}}</a></span></p>
        </div>
    </div>
    @endguest
@endsection


