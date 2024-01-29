@extends('layouts.app')

@section('tittle')
    - {{__('traslate.profile.profile')}} {{$user->username}}
@endsection

{{-- @section('titulo')
Perfil: {{$user->username}}
@endsection --}}

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full  flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 sm:flex sm:justify-items-center md:flex md:justify-end">
                @if ($user->imagen_perfil == "")
                <img class="rounded-full w-44 h-44 md:w-60 md:h-60 mx-auto my-auto md:mx-px border-style" src="{{ asset('img/usuario.svg') }}" >
                @else  
                <img class="mx-auto my-auto md:mx-px md:content-end rounded-full w-44 h-44 md:w-60 md:h-60 object-cover object-top border-style" src="{{ asset('perfiles/' . $user->imagen_perfil) }}" >
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
                @auth
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
                @endauth

                <div class="flex mt-5">
                    <p class="text-xl mb-3 font-bold"> {{$user->followers->count()}}
                        @if ($user->followers->count() == 1)
                        <span class="font-normal">{{__('traslate.follow.follower')}}</span>
                        @else
                            <span class="font-normal">{{__('traslate.follow.followers')}}</span>
                        @endif

                    </p>
                    
                    <p class=" text-xl mb-3 font-bold  ml-2"> {{$user->following->count()}}
                        <span class="font-normal">{{__('traslate.profile.following')}}</span>
                    </p>
                    
                    <p class="text-xl mb-3 font-bold  ml-2"> {{$posts->count()}}
                        <span class="font-normal">{{__('traslate.profile.post')}}</span>
                    </p>
                </div>


                @if ($user->descripcion_perfil == "")
                    
                @else
                    <p style="white-space: pre-line;" class="mt-3">{{$user->descripcion_perfil}}</p>
                @endif
            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        @auth
            <h2 class="text-4xl text-center my-10 font-black">{{__('traslate.profile.posts')}}</h2>
            @if ($user->id !== auth()->user()->id)
                @if ($user->siguiendo(auth()->user()) && auth()->user()->siguiendo($user))
                    @if ($posts->count())
                        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:lg:grid-cols-3 gap-4">
                            @foreach($posts as $post)
                                <div class="relative overflow-hidden aspect-square group transition-transform transform hover:scale-105">
                                    <a href="{{ route('post.show', ['post' => $post, 'user' => $user]) }}">
                                        <img class="object-cover object-top w-full h-full" src="{{ asset('upload') . '/' . $post->imagen }}" alt="img_post">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="my-10">
                            {{$posts->links('pagination::tailwind')}}
                        </div>
                    @else
                        <p class="text-gray-600 uppercase text-sm text-center font-bold">{{__('traslate.profile.noposts')}}</p>
                    @endif
                @elseif ($user->siguiendo(auth()->user()))
                    <div class="flex justify-center items-center rounded-lg">
                        {!! trans('traslate.follow.message.imagen_follow_no_follow') !!} <!-- Esto mostrará la imagen de seguir -->
                    </div>
                @elseif (auth()->user()->siguiendo($user))
                    <div class="flex justify-center items-center rounded-lg">
                        {!! trans('traslate.follow.message.imagen__no_follow_follow') !!} <!-- Esto mostrará la imagen de seguir -->
                    </div>
                @else
                    <div class="flex justify-center items-center rounded-lg">
                        {!! trans('traslate.follow.message.imagen_no_follow') !!} <!-- Esto mostrará la imagen de seguir -->
                    </div>
                @endif
            @else
                <!-- Muestra el contenido del perfil del usuario autenticado -->
                @if ($posts->count())
                    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:lg:grid-cols-3 gap-4">
                        @foreach($posts as $post)
                            <div class="relative overflow-hidden aspect-square group transition-transform transform hover:scale-105 shadow-2xl">
                                <a href="{{ route('post.show', ['post' => $post, 'user' => $user]) }}">
                                    <img class="object-cover object-top w-full h-full" src="{{ asset('upload') . '/' . $post->imagen }}" alt="img_post">
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="my-10">
                        {{$posts->links('pagination::tailwind')}}
                    </div>
                @else
                    <p class="text-gray-600 uppercase text-sm text-center font-bold">{{__('traslate.profile.noposts')}}</p>
                @endif
            @endif
        @endauth
    </section>
    
    
@endsection