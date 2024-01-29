@extends('layouts.app')


@section('tittle')
 - {{$post->titulo}}
@endsection

{{-- @section('titulo')
 {{$post->titulo}}
@endsection --}}
@if ($user->id !== auth()->user()->id)
    @if ($user->siguiendo(auth()->user()) && auth()->user()->siguiendo($user))
        @section('contenido')
            <div class="container flex flex-col md:flex-row mx-auto gap-5">        

                <div class="md:w-1/2 flex-col justify-center  rounded-lg ">
                    <div class=" bg-comentary p-2 rounded-md shadow-lg">
                        @auth
                            @if ($post->user_id === auth()->user()->id)
                            <div class="text-left mb-2">
                                <div class="relative inline-block text-left">
                                    <div class="w-32">
                                        <button type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button_delete" aria-expanded="true" aria-haspopup="true">
                                            {{__('traslate.posts.option')}}
                                            <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                
                                    <div class="absolute right-0 z-10 mt-2 w-32 origin-top-left rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                        <div class=" " role="none">
                                            <form method="POST" action="{{ route('post.destroy', $post )}}" class="m-1 justify-center">
                                                @method('DELETE')
                                                @csrf
                                                <input value="{{__('traslate.posts.dpost')}}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded cursor-pointer text-sm" type="submit"/>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            @endif
                        @endauth
                        @if ($post->titulo == "Sin Titulo")
                        @else
                        <p class="text-center text-4xl color-comentari pb-5 font-bold">{{$post->titulo}}</p>
                        @endif
                        
                        <img class="mx-auto w-full  rounded-md" src="{{ asset('upload') . '/' . $post->imagen}}" alt="img_post" >
                    </div>

                </div>

                <div class="md:w-1/2 flex-col ">
                    <div class="shadow-lg  p-5 mb-5 rounded-md bg-comentary">
                        <div class="w-8/12 lg:w-6/12 sm:flex justify-items-start flex justify-start pb-5">
                            @if ($user->imagen_perfil == "")
                            <img class="rounded-full w-20 h-20" src="{{ asset('img/usuario.svg') }}" >
                            @else
                            <img class="rounded-full w-20 h-20 border-4 object-cover object-top border-gray-900" src="{{ asset('perfiles/' . $user->imagen_perfil) }}" >
                            @endif
                            <span class="post-user font-bold text-3xl flex justify-center items-center pl-5 color-comentari">{{$post->user->username}}</span>
                        </div>
                            
                        <hr>
                        <div class="mb-5">
                            <p class="post-user text-xl font-bold pt-4 color-comentari">{{__('traslate.posts.description')}}</p>
                            <p class="post-user mt-5 max-h-28 overflow-y-scroll scrollbar-thin color-comentari" >{{$post->descripcion}}</p>
                        </div>
                        <hr> 
                        <div class="flex"> 
                            <div class="w-1/2 mt-3">
                                <div class="flex items-center">
                                    @auth
                                        <livewire:like-post :post="$post"/>
                                        {{-- @if ($post->checklikes(auth()->user()))
                                        <form action="{{ route('post.like.destroy', $post) }} " method="POST">
                                                @method('DELETE')
                                                @csrf

                                            </form>
                                        @else
                                        <form action="{{ route('post.like.store', $post) }} " method="POST">
                                            @csrf
                                            <button type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                                </svg>
                                            </button>
                                        </form>
                                        @endif --}}

                                    @endauth

                                    ㅤ
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                                    </svg>
                                    
                                    <span class="post-user pb-2 color-comentari"> {{$post->comentarios->count()}}</span>
                                </div>
                            </div>
                            <div class="w-1/2 mt-3 text-end">
                                <p class="text-sm color-comentari">{{$post->created_at->diffForHumans()}}</p>
                            </div>
                        </div>

                    </div>
                    <div class="shadow-lg bg-comentary p-5 mb-5 rounded-md border">
                        <p class="comentarios text-xl font-bold text-center color-comentari">{{__('traslate.posts.comments')}}</p>
                        @if (session('mensaje'))
                            <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                                {{session('mensaje')}}
                            </div>
                        @endif
                        <hr class="mb-5 mt-5">
                        <div class="mb-5 max-h-96 overflow-y-scroll scrollbar-thin">
                            @if ($post->comentarios->count())
                            @foreach ($post->comentarios->sortByDesc('created_at') as $comentario)
                            <div class=" border-gray-300 ">
                                <div class="flex">
                                    @if ($comentario->user->imagen_perfil == "")
                                    <img class="rounded-full w-16 h-16" src="{{ asset('img/usuario.svg') }}" alt="">
                                    @elseif ($comentario->user && $comentario->user->imagen_perfil)
                                        <img class="rounded-full w-16 h-16 object-cover object-top border-2 border-gray-900" src="{{ asset('perfiles/' . $comentario->user->imagen_perfil) }}" alt="">
                                    @else
                                        <img class="rounded-full w-16 h-16" src="{{ asset('img/usuario.svg') }}" alt="">
                                    @endif
                        
                                    <p class="flex justify-center items-center p-3">
                                        <span class="comentarios">
                                            <a href="{{ route('post.index', $comentario->user) }}" class="font-bold color-comentari">{{ str_replace('-', ' ', $comentario->user->username)}}</a>
                                        </span>
                                        
                                    </p>
                                </div>
                                <span class="comentarios color-comentari">ﾠ{{ $comentario->comentario }}</span>
                                <p class="text-sm color-comentari flex justify-end items-end">{{ $comentario->created_at->diffForHumans()}}</p>
                            </div>
                            
                        @endforeach
                            @else
                                <p class="color-comentari text-center font-bold">{{__('traslate.posts.nocomments')}}</p>
                            @endif
                        </div>
                        {{-- <p class="text-gray-500 text-xl text-center">Sin comentarios</p> --}}
                    </div>
                    @auth
                    <div class=" shadow bg-comentary p-5 mb-5 rounded-md">
                        <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                            @csrf 
                            <div class="relative mb-3">
                                <label for="comentario" class="mb-2 block uppercase color-comentari font-bold">{{__('traslate.posts.addcomment')}}</label>
                                <textarea id="comentario" name="comentario" class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror" placeholder="{{__('traslate.posts.pdescription')}}">{{ old('comentario')}}</textarea>
                                @error('comentario')
                                    <p class="text-red-700">{{ $message }}</p>
                                @enderror
                            </div>

                            <input type="submit"
                            value="{{__('traslate.posts.addcomment')}}"
                            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                        </form>
                    </div>
                    @endauth
                </div>
            </div>
        @endsection

    @elseif ($user->siguiendo(auth()->user()))
        @section('contenido')
        <div class="w-full flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 sm:flex sm:justify-items-center md:flex md:justify-end">
                @if ($user->imagen_perfil == "")
                <img class="rounded-full w-60 h-60" src="{{ asset('img/usuario.svg') }}" >
                @else  
                <img class="rounded-full w-60 h-60 object-cover object-top border-2 border-gray-900" src="{{ asset('perfiles/' . $user->imagen_perfil) }}" >
                @endif
            </div> 

            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
                <div class="flex items-center gap-2">
                    <p class="text-5xl font-bold">{{str_replace('-', ' ', $user->username)}}</p>
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{ route('perfil.index')}}" class="text-gray-500 hover:text-gray-700 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>                              
                            </a>
                        @endif
                    @endauth
                </div>
                @if ($user->id !== auth()->user()->id)
                    @if (!$user->siguiendo(auth()->user()))
                    <div class="pt-4">
                        <form action="{{ route('users.follow', $user)}}" method="POST">
                            @csrf
                            <input type="submit" class="bg-gray-500 transition duration-300 ease-in-out hover:bg-blue-500 text-white uppercase rounded-lg px-3 py-1 text-lg font-bold cursor-pointer" value="{{__('traslate.follow.follow')}}">
                        </form>
                    </div>
                    @else
                    <div class="pt-4">
                        <form action="{{ route('users.unfollow', $user)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="bg-gray-500 transition duration-300 ease-in-out hover:bg-red-500 text-white uppercase rounded-lg px-3 py-1 text-lg font-bold cursor-pointer" value="{{__('traslate.follow.unfollow')}}">
                        </form>
                    </div>
                    @endif
                    {{-- agregamos esta condicional para que el boton no aparezca en la pagina de nosotros y solo se muestre en otros perfiles diferentes para para no auto seguirnos --}}
                @endif
            </div>
        </div>
        <div class="flex justify-center items-center rounded-lg">
            {!! trans('traslate.follow.message.imagen_follow_no_follow') !!} <!-- Esto mostrará la imagen de seguir -->
        </div>
        @endsection

    @elseif (auth()->user()->siguiendo($user))
        @section('contenido')
        <div class="w-full flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 sm:flex sm:justify-items-center md:flex md:justify-end">
                @if ($user->imagen_perfil == "")
                <img class="rounded-full w-60 h-60" src="{{ asset('img/usuario.svg') }}" >
                @else  
                <img class="rounded-full w-60 h-60 object-cover object-top border-2 border-gray-900" src="{{ asset('perfiles/' . $user->imagen_perfil) }}" >
                @endif
            </div> 

            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
                <div class="flex items-center gap-2">
                    <p class="text-5xl font-bold">{{str_replace('-', ' ', $user->username)}}</p>
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{ route('perfil.index')}}" class="text-gray-500 hover:text-gray-700 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>                              
                            </a>
                        @endif
                    @endauth
                </div>
                @if ($user->id !== auth()->user()->id)
                    @if (!$user->siguiendo(auth()->user()))
                    <div class="pt-4">
                        <form action="{{ route('users.follow', $user)}}" method="POST">
                            @csrf
                            <input type="submit" class="bg-gray-500 transition duration-300 ease-in-out hover:bg-blue-500 text-white uppercase rounded-lg px-3 py-1 text-lg font-bold cursor-pointer" value="{{__('traslate.follow.follow')}}">
                        </form>
                    </div>
                    @else
                    <div class="pt-4">
                        <form action="{{ route('users.unfollow', $user)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="bg-gray-500 transition duration-300 ease-in-out hover:bg-red-500 text-white uppercase rounded-lg px-3 py-1 text-lg font-bold cursor-pointer" value="{{__('traslate.follow.unfollow')}}">
                        </form>
                    </div>
                    @endif
                    {{-- agregamos esta condicional para que el boton no aparezca en la pagina de nosotros y solo se muestre en otros perfiles diferentes para para no auto seguirnos --}}
                @endif
            </div>
        </div>
        <div class="flex justify-center items-center rounded-lg">
            {!! trans('traslate.follow.message.imagen__no_follow_follow') !!} <!-- Esto mostrará la imagen de seguir -->
        </div>
        @endsection

    @else

    @section('contenido')
        <div class="w-full flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 sm:flex sm:justify-items-center md:flex md:justify-end">
                @if ($user->imagen_perfil == "")
                <img class="rounded-full w-60 h-60" src="{{ asset('img/usuario.svg') }}" >
                @else  
                <img class="rounded-full w-60 h-60 object-cover object-top border-2 border-gray-900" src="{{ asset('perfiles/' . $user->imagen_perfil) }}" >
                @endif
            </div> 

            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
                <div class="flex items-center gap-2">
                    <p class="text-5xl font-bold">{{str_replace('-', ' ', $user->username)}}</p>
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{ route('perfil.index')}}" class="text-gray-500 hover:text-gray-700 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>                              
                            </a>
                        @endif
                    @endauth
                </div>
                @if ($user->id !== auth()->user()->id)
                    @if (!$user->siguiendo(auth()->user()))
                    <div class="pt-4">
                        <form action="{{ route('users.follow', $user)}}" method="POST">
                            @csrf
                            <input type="submit" class="bg-gray-500 transition duration-300 ease-in-out hover:bg-blue-500 text-white uppercase rounded-lg px-3 py-1 text-lg font-bold cursor-pointer" value="{{__('traslate.follow.follow')}}">
                        </form>
                    </div>
                    @else
                    <div class="pt-4">
                        <form action="{{ route('users.unfollow', $user)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="bg-gray-500 transition duration-300 ease-in-out hover:bg-red-500 text-white uppercase rounded-lg px-3 py-1 text-lg font-bold cursor-pointer" value="{{__('traslate.follow.unfollow')}}">
                        </form>
                    </div>
                    @endif
                    {{-- agregamos esta condicional para que el boton no aparezca en la pagina de nosotros y solo se muestre en otros perfiles diferentes para para no auto seguirnos --}}
                @endif
            </div>
        </div>
        <div class="flex justify-center items-center rounded-lg">
            {!! trans('traslate.follow.message.imagen_no_follow') !!} <!-- Esto mostrará la imagen de seguir -->
        </div>
    @endsection

    @endif
@else
    @section('contenido')
    <div class="container flex flex-col md:flex-row mx-auto gap-5">        
        <div class="md:w-1/2 flex-col justify-center  rounded-lg ">
            <div class=" bg-comentary p-2 rounded-md shadow-lg">
                @auth
                    @if ($post->user_id === auth()->user()->id)
                    <div class="text-left mb-2">
                        <div class="relative inline-block text-left">
                            <div class="w-32">
                                <button type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button_delete" aria-expanded="true" aria-haspopup="true">
                                    {{__('traslate.posts.option')}}
                                    <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                            <div class="absolute right-0 z-10 mt-2 w-32 origin-top-left rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                <div class=" " role="none">
                                    <form method="POST" action="{{ route('post.destroy', $post )}}" class="m-1 justify-center">
                                        @method('DELETE')
                                        @csrf
                                        <input value="{{__('traslate.posts.dpost')}}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded cursor-pointer text-sm" type="submit"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endauth
                @if ($post->titulo == "Sin Titulo")
                @else
                <p class="text-center text-4xl color-comentari pb-5 font-bold">{{$post->titulo}}</p>
                @endif
                <img class="mx-auto w-full  rounded-md" src="{{ asset('upload') . '/' . $post->imagen}}" alt="img_post" >
            </div>
        </div>
        <div class="md:w-1/2 flex-col ">
            <div class="shadow-lg  p-5 mb-5 rounded-md bg-comentary">
                <div class="w-8/12 lg:w-6/12 sm:flex justify-items-start flex justify-start pb-5">
                    @if ($user->imagen_perfil == "")
                    <img class="rounded-full w-20 h-20" src="{{ asset('img/usuario.svg') }}" >
                    @else
                    <img class="rounded-full w-20 h-20 border-4 object-cover object-top border-gray-900" src="{{ asset('perfiles/' . $user->imagen_perfil) }}" >
                    @endif
                    <span class="post-user font-bold text-3xl flex justify-center items-center pl-5 color-comentari">{{$post->user->username}}</span>
                </div>
                    
                <hr>
                <div class="mb-5">
                    <p class="post-user text-xl font-bold pt-4 color-comentari">{{__('traslate.posts.description')}}</p>
                    <p class="post-user mt-5 max-h-28 overflow-y-scroll scrollbar-thin color-comentari" >{{$post->descripcion}}</p>
                </div>
                <hr>
                <div class="flex">
                    <div class="w-1/2 mt-3">
                        <div class="flex items-center">
                            @auth
                            <livewire:like-post :post="$post"/>
                                {{-- @if ($post->checklikes(auth()->user()))
                                <form action="{{ route('post.like.destroy', $post) }} " method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                            </svg>
                                            
                                        </button>
                                    </form>
                                @else
                                <form action="{{ route('post.like.store', $post) }} " method="POST">
                                    @csrf
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                        </svg>
                                    </button>
                                </form>
                                @endif --}}

                            @endauth
                            ㅤ
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                            </svg>
                            
                            <span class="post-user pb-2 color-comentari"> {{$post->comentarios->count()}}</span>
                        </div>
                    </div>
                    <div class="w-1/2 mt-3 text-end">
                        <p class="text-sm color-comentari">{{$post->created_at->diffForHumans()}}</p>
                    </div>
                </div>

            </div>
            <div class="shadow-lg bg-comentary p-5 mb-5 rounded-md border">
                <p class="comentarios text-xl font-bold text-center color-comentari">{{__('traslate.posts.comments')}}</p>
                @if (session('mensaje'))
                    <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                        {{session('mensaje')}}
                    </div>
                @endif
                <hr class="mb-5 mt-5">
                <div class="mb-5 max-h-96 overflow-y-scroll scrollbar-thin">
                    @if ($post->comentarios->count())
                    @foreach ($post->comentarios->sortByDesc('created_at') as $comentario)
                    <div class=" border-gray-300 ">
                        <div class="flex">
                            @if ($comentario->user->imagen_perfil == "")
                            <img class="rounded-full w-16 h-16" src="{{ asset('img/usuario.svg') }}" alt="">
                            @elseif ($comentario->user && $comentario->user->imagen_perfil)
                                <img class="rounded-full w-16 h-16 object-cover object-top border-2 border-gray-900" src="{{ asset('perfiles/' . $comentario->user->imagen_perfil) }}" alt="">
                            @else
                                <img class="rounded-full w-16 h-16" src="{{ asset('img/usuario.svg') }}" alt="">
                            @endif
                
                            <p class="flex justify-center items-center p-3">
                                <span class="comentarios">
                                    <a href="{{ route('post.index', $comentario->user) }}" class="font-bold color-comentari">{{ str_replace('-', ' ', $comentario->user->username)}}</a>
                                </span>
                                
                            </p>
                        </div>
                        <span class="comentarios color-comentari">ﾠ{{ $comentario->comentario }}</span>
                        <p class="text-sm color-comentari flex justify-end items-end">{{ $comentario->created_at->diffForHumans()}}</p>
                    </div>
                    
                @endforeach
                    @else
                        <p class="color-comentari text-center font-bold">{{__('traslate.posts.nocomments')}}</p>
                    @endif
                </div>
                {{-- <p class="text-gray-500 text-xl text-center">Sin comentarios</p> --}}
            </div>
            @auth
            <div class=" shadow bg-comentary p-5 mb-5 rounded-md">
                <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                    @csrf 
                    <div class="relative mb-3">
                        <label for="comentario" class="mb-2 block uppercase color-comentari font-bold">{{__('traslate.posts.addcomment')}}</label>
                        <textarea id="comentario" name="comentario" class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror" placeholder="{{__('traslate.posts.pdescription')}}">{{ old('comentario')}}</textarea>
                        @error('comentario')
                            <p class="text-red-700">{{ $message }}</p>
                        @enderror
                    </div>

                    <input type="submit"
                    value="{{__('traslate.posts.addcomment')}}"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                </form>
            </div>
            @endauth
        </div>
    </div>
    @endsection
@endif