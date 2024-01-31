@extends('layouts.app')
@php
$userCount = \App\Models\User::count();
@endphp
@section('tittle')
Registro
@endsection

@section('titulo')

@endsection

@section('contenido')
<div class="md:flex md:justify-center md:items-center">
    <div class="md:w-6/12">
        <img class="img_registro" width="80%" src="{{asset('img/peep-sitting-regis.png')}}" alt="imagen login">
    </div>
    <div class="md:w-6/12 bg-comentary p-6 rounded-lg shadow-lg border">
        <p class="text-2xl text-center font-bold color-comentari">{{__('traslate.registrer.title')}}</p>
        <p class="text-2xl text-center font-bold color-comentari">{{__('traslate.registrer.join')}}<span
                class="color-comentari">Devstagram</span><span>, {{__('traslate.registrer.already')}}
                {{$userCount}}</span></p>
        <br>
        <hr>
        <br>
        <form action="{{route('crear')}}" method="POST" novalidate>
            @csrf
            <div class="relative mb-3">
                <input type="text" id="name" name="name" type="text"
                    class="block rounded-t-lg px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('name') border-red-500 @enderror"
                    placeholder=" " value="{{ old('name')}}" />
                @error('name')
                <p class="text-red-700">{{ $message }}</p>
                @enderror
                <label for="name"
                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto ">{{__('traslate.registrer.name')}}</label>
            </div>

            <div class="relative mb-3">
                <input type="text" id="username" name="username" type="text"
                    class="block rounded-t-lg px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('name') border-red-500 @enderror"
                    placeholder=" " value="{{ old('username')}}" />
                @error('username')
                <p class="text-red-700">{{ $message }}</p>
                @enderror
                <label for="username"
                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">{{__('traslate.registrer.username')}}</label>
            </div>

            <div class="relative mb-3">
                <input type="email" id="email" name="email" type="text"
                    class="block rounded-t-lg px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " value="{{ old('email')}}" />
                @error('email')
                <p class="text-red-700">{{ $message }}</p>
                @enderror
                <label for="email"
                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">{{__('traslate.registrer.email')}}</label>
            </div>

            <div class="relative mb-3">
                <input type="password" id="password" name="password" type="text"
                    class="block rounded-t-lg px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " />
                @error('password')
                <p class="text-red-700">{{ $message }}</p>
                @enderror
                <label for="password"
                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">{{__('traslate.registrer.password')}}</label>
            </div>

            <div class="relative mb-3">
                <input type="password" id="password_confirmation" name="password_confirmation" type="text"
                    class="block rounded-t-lg px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " />
                {{-- @error('password_confirmation')
                <p class="text-red-700">{{ $message }}</p>
                @enderror --}}
                <label for="password_confirmation"
                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">{{__('traslate.registrer.repassword')}}</label>
            </div>

            <input type="checkbox" name="tac" id="tac" />
            <span class="color-comentari"> {{__('traslate.registrer.tac_1')}}
                <span>
                    <a class="text-blue-500">{{__('traslate.registrer.tac_2')}}</a>
                </span>?
            </span>
            @error('tac')
            <p class="text-red-700">{{ __('traslate.registrer.tycunchecket') }}</p>
            @enderror
            {{-- <input type="text" value="" name="descripcionperfil"> --}}
            <input type="submit" value="{{__('traslate.registrer.create')}}"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg mt-3">
        </form>
        <br>
        <p class="text-center font-bold">{{__('traslate.registrer.acounte')}}<span><a
                    class="text-blue-500 hover:text-blue-800" href="{{route('login')}}">
                    {{__('traslate.registrer.acounte_1')}}</a></span></p>
    </div>
</div>


@endsection