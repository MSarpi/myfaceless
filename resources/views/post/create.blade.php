@extends('layouts.app')

@section('tittle')
- new post
@endsection

{{-- @section('titulo')
crea una nueva publicacion
@endsection --}}

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush
@section('contenido')

<div class="md:flex md:justify-center md:items-center md:gap-5">
    <div class="md:w-5/12 lg:w-8/12 p-5 bg-white rounded-md">
        <form action="{{route('imagenes.store')}}" method="POST" enctype="multipart/form-data" id="dropzone"
            class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
            @csrf
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
            </svg>
        </form>
        @error('imagen')
        <p class="text-red-700">{{ $message }}</p>
        @enderror

        <form action="{{route('post.store')}}" method="POST" novalidate>
            @csrf
            <div class="relative mb-3 mt-3">
                <input id="titulo" name="titulo" type="text"
                    class="block rounded-t-lg px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('name') border-red-500 @enderror"
                    placeholder=" " value="{{ old('titulo')}}" />
                {{-- @error('titulo')
                <p class="text-red-700">{{ $message }}</p>
                @enderror --}}
                <label for="titulo"
                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto ">Titulo
                    de la publicación</label>
            </div>

            <div class="relative mb-3">
                <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">Descripcion</label>
                <textarea id="descripcion" name="descripcion"
                    class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                    placeholder="Descripción de tu publicacion">{{ old('descripcion')}}</textarea>
                {{-- @error('descripcion')
                <p class="text-red-700">{{ $message }}</p>
                @enderror --}}
            </div>

            <div class="mb-5">
                <input type="hidden" name="imagen" value="{{ old('imagen') }}" />
            </div>
            <input type="submit" value="Crear Publicación"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
        </form>
    </div>
</div>
@endsection