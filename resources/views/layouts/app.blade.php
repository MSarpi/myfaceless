<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @stack('styles')
  <title>Faceless @yield('tittle')</title>
  @vite('resources/css/edit.css')
  @vite('resources/css/app.css')
  @vite('resources/css/csspeeps.css')
  @vite('resources/css/scroll.css')
  @vite('resources/js/app.js')
  @vite('resources/js/sidebar.js')
  @livewireStyles
</head>

<body>
  <div class="menu">
    <ion-icon name="menu-outline"></ion-icon>
    <ion-icon name="close-outline"></ion-icon>
  </div>
  <div class="barra-lateral border-r-2 border-gray-600">
    <div>
      <div class="nombre-pagina ml-1">
        <ion-icon id="cloud" name="cloud-outline"></ion-icon>
        <span><a href="/" class="font-black">Faceless</a></span>
      </div>
      <hr>
      @auth
      @if (auth()->user()->imagen_perfil == "")
      <a class="flex mb-5 mt-4" href="{{route('post.index', ['user' => auth()->user()->username])}}">
        <img class="rounded-full w-12 h-12 border-style ml-1" src="{{asset('img/usuario.svg')}}" alt="">
        <span class="my-profile">{{__('traslate.navlateral.profile')}}</span>
      </a>
      @else
      <a class="flex mb-5 mt-4" href="{{route('post.index', ['user' => auth()->user()->username])}}">
        <img class="rounded-full w-12 h-12 object-cover object-top border-style ml-1"
          src="{{asset('perfiles') . '/' . auth()->user()->imagen_perfil}}" alt="">
        <span class="my-profile">{{__('traslate.navlateral.profile')}}</span>
      </a>
      @endif

      @endauth

      @auth
      <a href="{{route('post.create')}}" class="boton">
        <ion-icon name="add-outline"></ion-icon> <span class="new_post">{{__('traslate.navlateral.newpost')}}</span>
      </a>
      @endauth
    </div>
    <nav class="navegacion">
      @auth
      <ul>
        <li>
          <a class="nombre-pagina icon-ico-mod" href="/">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span>{{__('traslate.navlateral.home')}}</span>
          </a>
        </li>
        <li>
          @if (auth()->user()->id)
          <a class=" svg nombre-pagina icon-ico-mod" href="{{ route('perfil.index')}}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
            <span>{{__('traslate.navlateral.settings')}}</span>
          </a>
          @endif
        </li>
      </ul>
      <hr class="pb-5">
      @php
      $users = DB::select('SELECT
      u2.id,
      u2.username,
      u2.imagen_perfil,
      COUNT(*) AS cantidad_de_seguidores
      FROM
      redev.followers AS f1
      JOIN
      redev.followers AS f2 ON f1.follower_id = f2.user_id
      JOIN
      redev.users AS u2 ON f2.user_id = u2.id
      WHERE
      f1.user_id = ' . auth()->user()->id . '
      AND f2.follower_id = ' . auth()->user()->id . '
      GROUP BY
      u2.id, u2.username, u2.imagen_perfil ;');

      // Convertir los resultados a objetos estándar
      $users = array_map(function ($user) {
      return (object) $user;
      }, $users);
      @endphp

      @if(count($users) >= 1)
      @foreach ($users as $u)
      <div class="flex gap-2 items-center mb-5">

        @if ($u->imagen_perfil == "")
        <a class="flex" href="{{route('post.index', ['user' => $u->username])}}">
          <img class="rounded-full w-12 h-12 border-style ml-1" src="{{asset('img/usuario.svg')}}" alt="">
          <span class="follower-profile pl-2 text-xl">{{$u->username}}</span>
        </a>
        @else
        <a class="flex " href="{{route('post.index', ['user' => $u->username])}}">
          <img class="rounded-full w-12 h-12 object-cover object-top border-style ml-1"
            src="{{asset('perfiles') . '/' .$u->imagen_perfil}}" alt="">
          <span class="follower-profile pl-2 text-xl">{{$u->username}}</span>
        </a>
        @endif
      </div>
      @endforeach
      @else
      Sin seguidores
      @endif
      @endauth

      @guest
      <ul>
        <li>
          <a class="nombre-pagina mt-5" href="{{ route('login') }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
            <span class="pt-1 pl-2">{{__('traslate.navlateral.login')}}</span>
          </a>
        </li>

        <li>
          <a class="nombre-pagina" href="{{route('registro')}}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
            </svg>
            <span class="pt-1 pl-2">{{__('traslate.navlateral.signup')}}</span>
          </a>
        </li>
      </ul>
      @endguest
    </nav>

    <div>
      @auth
      <div class="linea"></div>

      <br>
      <div class="w-full inline-block text-left">
        <div>
          <button type="button"
            class="inline-flex w-56 justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
            id="menu-button" aria-expanded="true" aria-haspopup="true">
            {{__('traslate.navlateral.language')}}
            <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd"
                d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                clip-rule="evenodd" />
            </svg>
          </button>
        </div>

        <div
          class="absolute z-10 -mt-20 w-56 origin-top-center rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
          role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
          <div class="flex py-1 justify-center" role="none">
            <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
            <a href="{{url('lang', 'en')}}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
              id="menu-item-0"><span><img class="w-10 h-10 rounded-full"
                  src="{{asset('img/estados-unidos.png')}}"></span>{{__('traslate.navlateral.english')}}</a>
            <a href="{{url('lang', 'es')}}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
              id="menu-item-1"><img class="w-10 h-10 rounded-full"
                src="{{asset('img/chile.png')}}">{{__('traslate.navlateral.spanish')}}</a>
          </div>
        </div>
      </div>

      <div class="modo-oscuro">
        <div class="info">
          <ion-icon name="moon-outline"></ion-icon>
          <span>{{__('traslate.navlateral.mode')}}</span>
        </div>
        <div class="switch" id="tuPalanca">
          <div class="base">
            <div class="circulo" id="tuCirculo"></div>
          </div>
        </div>
      </div>

      <nav>
        <ul>
          <li>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="btn-logout nombre-pagina">
                <a class="svg icon-ico-mod flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                  </svg>
                  <span>{{__('traslate.navlateral.logout')}}</span>
                </a>
              </button>
            </form>
          </li>
        </ul>
      </nav>
      @endauth
      @guest
      <div class="linea"></div>

      <br>
      <div class="w-full inline-block text-left">
        <div>
          <button type="button"
            class="inline-flex w-56 justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
            id="menu-button" aria-expanded="true" aria-haspopup="true">
            {{__('traslate.navlateral.language')}}
            <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd"
                d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                clip-rule="evenodd" />
            </svg>
          </button>
        </div>

        <div
          class="absolute z-10 mt-2 w-56 origin-top-center rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
          role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
          <div class="flex py-1 justify-center" role="none">
            <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
            <a href="{{url('lang', 'en')}}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
              id="menu-item-0"><span><img class="w-10 h-10 rounded-full"
                  src="{{asset('img/estados-unidos.png')}}"></span>{{__('traslate.navlateral.english')}}</a>
            <a href="{{url('lang', 'es')}}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
              id="menu-item-1"><img class="w-10 h-10 rounded-full"
                src="{{asset('img/chile.png')}}">{{__('traslate.navlateral.spanish')}}</a>
          </div>
        </div>
      </div>


      <div class="modo-oscuro">
        <div class="info">
          <ion-icon name="moon-outline"></ion-icon>
          <span>{{__('traslate.navlateral.mode')}}</span>
        </div>
        <div class="switch" id="tuPalanca">
          <div class="base">
            <div class="circulo" id="tuCirculo"></div>
          </div>
        </div>
      </div>
      @endguest
    </div>
  </div>

  <main class="w-12/12">
    <h2 class="font-black text-center text-3xl mb-10">@yield('titulo')</h2>
    @yield('contenido')

    {{-- <footer class="text-center font-bold p-5  mt-10">
      <span>Devstagram - Todos los derechos reservados {{now() -> year}}</span>
    </footer> --}}

  </main>

  {{-- <footer>
    <!-- Contenido del pie de página -->
    <span class="text-gray-300">Devstagram - Todos los derechos reservados {{now() -> year}}</span>
  </footer> --}}
  {{-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@2"></script> --}}
  {{-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script> --}}
  @livewireScripts
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>