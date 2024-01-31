@extends('layouts.app')

@section('tittle')
- {{__('traslate.setting.setting')}}
@endsection

@section('contenido')
<div class="md:flex md:justify-center md:gap-5 md:items-center m-5">
    <div class="md:w-6/12 p-3 bg-comentary shadow-lg rounded-md">
        <p class="font-black text-center text-4xl color-comentari">{{__('traslate.setting.modify')}}</p>
        <hr class="mt-5 mb-5">
        <form class="mt-10" action="{{ route('perfil.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="relative mb-5 p-2">
                <label for="avatar"
                    class="mb-2 block uppercase color-comentari font-bold">{{__('traslate.setting.picture')}}</label>
                <input id="avatar" name="avatar" type="file" accept=".png, .jpg, .jpeg, .jfif, .gif">
            </div>
            <div class="relative mb-3">
                <input type="text" id="username" name="username" type="text"
                    class="block rounded-t-lg px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900  dark:bg-gray-700 border-0 border-b-2  appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('name') border-red-500 @enderror"
                    placeholder=" " value="{{ str_replace('-', ' ', auth()->user()->username)}}" />
                @error('username')
                <p class="text-red-700">{{ $message }}</p>
                @enderror
                <label for="username"
                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">{{__('traslate.setting.username')}}</label>
            </div>

            <div class="relative mb-3">
                <label for="descripcion"
                    class="mb-2 block uppercase color-comentari font-bold">{{__('traslate.setting.description')}}</label>
                <textarea id="descripcion" name="descripcion"
                    class="border p-3 w-full rounded-lg h-40 @error('name') border-red-500 @enderror"
                    placeholder="Descripción de tu publicacion">{{auth()->user()->descripcion_perfil}}</textarea>
                <span id="charCountDesc" class="text-sm text-gray-500">255 caracteres restantes</span>
                @error('descripcion')
                <p class="text-red-700">{{ $message }}</p>
                @enderror
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    var textareaDesc = document.getElementById('descripcion');
                    var charCountDescSpan = document.getElementById('charCountDesc');
                    var maxLengthDesc = 255;
            
                    textareaDesc.addEventListener('input', function () {
                        var remainingCharsDesc = maxLengthDesc - textareaDesc.value.length;
                        charCountDescSpan.textContent = remainingCharsDesc + ' caracteres restantes';
            
                        // Puedes cambiar el estilo según la cantidad de caracteres restantes
                        if (remainingCharsDesc < 0) {
                            charCountDescSpan.style.color = 'red';
                        } else {
                            charCountDescSpan.style.color = 'gray';
                        }
                    });
                });
            </script>

            <input type="submit" value="{{__('traslate.setting.changes')}}"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
        </form>
    </div>
</div>

@endsection