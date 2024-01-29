
const cloud = document.getElementById("cloud");
const barraLateral = document.querySelector(".barra-lateral");
const spans = document.querySelectorAll("span");
// const palanca = document.querySelector(".switch");
// const circulo = document.querySelector(".circulo");
// const body = document.body;
const menu = document.querySelector(".menu");
const main = document.querySelector("main");



const palanca = document.getElementById("tuPalanca");  // Reemplaza "tuPalanca" con el ID real de tu palanca
const body = document.body;
const circulo = document.getElementById("tuCirculo");


menu.addEventListener("click",()=>{
    barraLateral.classList.toggle("max-barra-lateral");
    if(barraLateral.classList.contains("max-barra-lateral")){
        menu.children[0].style.display = "none";
        menu.children[1].style.display = "block";
    }
    else{
        menu.children[0].style.display = "block";
        menu.children[1].style.display = "none";
    }
    if(window.innerWidth<=320){
        barraLateral.classList.add("mini-barra-lateral");
        main.classList.add("min-main");
        spans.forEach((span)=>{
            span.classList.add("oculto");
        })
    }
});

// palanca.addEventListener("click", () => {
//     body.classList.toggle("dark-mode");
//     circulo.classList.toggle("prendido");
//     store(body.classList.contains("dark-mode"));
// });


cloud.addEventListener("click",()=>{
    barraLateral.classList.toggle("mini-barra-lateral");
    main.classList.toggle("min-main");
    spans.forEach((span)=>{
        span.classList.toggle("oculto");
    });
});

// Recuperar el estado del modo oscuro desde el almacenamiento local al cargar la página
const darkModeState = localStorage.getItem("darkMode") === "true";
body.classList.toggle("dark-mode", darkModeState);
circulo.classList.toggle("prendido", darkModeState);

palanca.addEventListener("click", () => {
    body.classList.toggle("dark-mode");
    circulo.classList.toggle("prendido");

    // Almacenar el estado del modo oscuro en el almacenamiento local
    localStorage.setItem("darkMode", body.classList.contains("dark-mode"));
});



document.addEventListener('DOMContentLoaded', function() {
    const menuButton = document.getElementById('menu-button');
    const menuDropdown = document.querySelector('.absolute');

    // Inicialmente, establece el menú como cerrado
    menuButton.setAttribute('aria-expanded', 'false');
    menuDropdown.classList.add('hidden');

    menuButton.addEventListener('click', function() {
      const expanded = menuButton.getAttribute('aria-expanded') === 'true';

      menuButton.setAttribute('aria-expanded', !expanded);
      menuDropdown.classList.toggle('hidden');
    });

    // Cierra el menú si se hace clic fuera de él
    document.addEventListener('click', function(event) {
      const isClickInsideMenu = menuButton.contains(event.target) || menuDropdown.contains(event.target);

      if (!isClickInsideMenu) {
        menuButton.setAttribute('aria-expanded', 'false');
        menuDropdown.classList.add('hidden');
      }
    });
  });

  document.addEventListener('DOMContentLoaded', function () {
    Alpine.start();
});

document.addEventListener('DOMContentLoaded', function () {
    const menuButton = document.getElementById('menu-button_delete');
    const dropdown = document.querySelector('.absolute.right-0');
  
    console.log(menuButton); // Verifica en la consola si menuButton está seleccionando el elemento correctamente.
    console.log(dropdown);   // Verifica en la consola si dropdown está seleccionando el elemento correctamente.
  
    menuButton.addEventListener('click', function () {
      dropdown.classList.toggle('hidden');
    });
  
    document.addEventListener('click', function (event) {
      if (!menuButton.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.classList.add('hidden');
      }
    });
  });