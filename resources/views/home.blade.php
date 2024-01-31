@extends('layouts.app')

@section('tittle')
- {{__('traslate.page.home')}}
@endsection

@section('titulo')
@auth
{{__('traslate.page.post')}}
@endauth
@guest

@endguest
@endsection

@section('contenido')
@auth
@if ($posts->count())
<div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
    @foreach($posts as $post)
    <div class="p-5 bg-comentary shadow-2xl rounded-md">
        <div class="flex items-center mb-3">
            @if ($post->user->imagen_perfil == "")
            <img class="rounded-full w-16 h-16 border-style" src="{{ asset('img/usuario.svg') }}">
            @else
            <img class="rounded-full w-16 h-16 object-cover object-top border-style"
                src="{{ asset('perfiles/' . $post->user->imagen_perfil) }}">
            @endif
            <span class="ml-4 items-center text-2xl">{{$post->user->username}}</span>
        </div>
        <div class="relative overflow-hidden aspect-square group transition-transform transform hover:scale-103">
            <a href="{{ route('post.show', ['post' => $post, 'user' => $post->user]) }}">
                <img class="object-cover object-top w-full h-full" src="{{ asset('upload') . '/' . $post->imagen }}"
                    alt="img_post">
            </a>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="flex justify-center items-center rounded-lg">
    {!! trans('traslate.follow.message.imagen__no_post') !!}
</div>

@endif
@endauth

@endsection