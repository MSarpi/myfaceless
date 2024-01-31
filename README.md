# MyFaceless

MyFaceless es una aplicación de libre uso inspirada en el diseño de Instagram. La característica distintiva es que los usuarios deben seguirse mutuamente para poder ver sus contenidos. Esto significa que será de contenido privado, y solo los usuarios que se sigan mutuamente podrán acceder a su contenido. De lo contrario, deberás esperar a que el usuario que seguiste comience a seguirte, o viceversa.

si tienes alguna duda o pregunta, contáctame acá: Miguel.sarpi@gmail.com.

# Para usar este proyecto adecuadamente necesitas tener instalado:

estos pasos son adecuados para su funcionamiento en windows, pero fue creado mediante docker con WSL con una distribución de ubuntu y "Sail", en las próximas actualizaciones traeré los pasos a pasos para que puedan usarlo de esa manera.

[PHP v8.1.12 o superior](https://www.php.net/downloads)  
[Laravel v10 o superior](https://laravel.com/)  
[composer v2.4.4 o superior](https://getcomposer.org/)  
[node v20.9.0](https://nodejs.org/en)  
[xampp](https://www.apachefriends.org/es/download.html)  
[ImageMagick (requerido si usaras windowds)](https://imagemagick.org/script/download.php)

Opcional:  
[vsCode](https://code.visualstudio.com/)  
[Dbeaver](Dbeaver)  
[git bash](https://git-scm.com/downloads)

## Configuración de XAMPP y Creación de Base de Datos Local

Esta guía te ayudará a configurar XAMPP y crear una base de datos local para tu aplicación.

### Paso 1: Descargar e Instalar XAMPP

Descarga e instala XAMPP desde [https://www.apachefriends.org/index.html](https://www.apachefriends.org/index.html).

### Paso 2: Iniciar Apache y MySQL

Inicia XAMPP y asegúrate de que los servicios de Apache y MySQL estén activos.

### Paso 3: Acceder a phpMyAdmin

Abre tu navegador y visita [http://localhost/phpmyadmin](http://localhost/phpmyadmin) para acceder a la interfaz de administración de MySQL (phpMyAdmin).

### Paso 4: Crear una Nueva Base de Datos

1. Haz clic en la pestaña "Bases de datos" en phpMyAdmin.
2. Ingresa un nombre para tu nueva base de datos en el campo "Crear nueva base de datos".
3. Haz clic en el botón "Crear".

Con esto ya tendremos una base de datos lista para usarse, debes guardar el nombre de la base de datos para usarlo a futuro.

## Guía de Instalación para MyFaceless

### Paso 1: Descargar el Repositorio

```bash
git clone https://github.com/MSarpi/myfaceless.git
```

### Paso 2: Instalar Dependencias

Después de descargar el repositorio, accede a la carpeta y ejecuta los siguientes comandos para instalar las dependencias dentro de la carpeta raíz del proyecto:

```bash
composer install
npm install
```

### Paso 3: Configurar el Archivo .env

Copia el archivo .env.example y pégalo en la misma raíz de la carpeta, renombrándolo como .env. Abre el archivo .env y modifica la entrada db_database con el nombre que pusiste al crear la tabla con xampp.  
debería quedar asi:

```php
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base_de_datos
DB_USERNAME=root
DB_PASSWORD=
```

### Paso 6: Migrar y Sembrar la Base de Datos (Laravel)

Si estás utilizando Laravel, ejecuta los siguientes comandos en tu terminal:

```bash
php artisan migrate --seed
```

Estos comandos crearán las tablas necesarias en tu base de datos y pueden llenarlas con datos de ejemplo si has configurado semillas (seeds).

¡Listo! Ahora deberías tener XAMPP configurado con una base de datos local para tu aplicación.

Recuerda personalizar según las necesidades específicas de tu proyecto. Esta guía asume que estás utilizando Laravel como se mencionó anteriormente, así que ajusta las instrucciones según el tipo de aplicación que estás desarrollando.

## License

[SarpiDesign](https://sarpidesign.netlify.app/)
