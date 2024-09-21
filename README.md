<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is... <details> a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.
</details>

## Learning Laravel and create project with Laravel


# **<span style="color: #ba3030;">Información para levantar proyecto de Laravel con auth0 <span>**


## Requisitos previos
 * PHP
 * Composer
 * Servidor web (en mi caso use el de Xampp)
 * Base de datos: MySQL, PostgreSQL, SQLite, etc. (también utilice Mysql de Xampp)


* El proyecto esta utilizando la BD Mysl de Xamp, se configuro en el puerto 3308, para que lo consideres en tu archivo .env porque por default es el puerto 3306.

* Debes crear tu cuenta de **Auth0** para obtener tus credenciales de registro de la aplicacion ya que las actuales seran desactivadas y debes reemplazarlas. [url](https://auth0.com/resources/whitepapers/Guia-del-Comprador-de-CIAM?utm_content=latamesmexicobrandauth0-pure%20brand-esciambuyersguide&utm_source=google&utm_campaign=latam_mult_mex_all_ciam-all_dg-ao_auth0_search_google_text_kw_utm2&utm_medium=cpc&utm_id=aNK4z0000004IjuGAE&utm_term=auth0-c&gad_source=1&gclid=CjwKCAjwl6-3BhBWEiwApN6_klT4dhNbxthfgT-iZJVSKgM1dhxFbdhphZ1GRp8klxMbwg5uSBJFJRoCGc8QAvD_BwE)

### Configura una Nueva Aplicación

* Puedes ver como iniciar una nueva aplicacion desde algun video de youtube como este: [link video](https://www.youtube.com/watch?v=DMfGA1eWYys)

* La documentacion de Laravel te da unos comandos, pero te dejo los que se usan en el video para crear el proyecto.


```
composer create-project laravel/laravel:^11.0 <aqui va el nombre que le quieras dar al proyecto>
```

* Ingresa a la carpeta de tu proyecto
```
cd <aqui va el nombre que le diste al proyecto>
```

* Puedes comprobar que ya esta funcionando si ves la documentaion de Laravel al ejecutar este comando:
```
php artisan serve
```

* Deten el servicio y agrega las rutas que usara Auth0 para su implementacion:
```
composer require auth0/login --update-with-all-dependencies
```

* Para configuraciones adicionales publicamos con el siguiente comando:
```
php artisan vendor:publish --tag auth0
```

* Ahora puedes ver las rutas por defaul que ya tiene el proyecto, deben aparecer las de Auth0:
```
php artisan route:list
```

* Ahora para terminar la configuracion hay que instalar el sdk de Auth0 en el proyecto con este comando:
```
curl -sSfL https://raw.githubusercontent.com/auth0/auth0-cli/main/install.sh | sh -s -- -b .
```

* Si por alguna razon no funciona el comando anterior, puedes ir a la documentacion del cli de Auth0 [link](https://github.com/auth0/auth0-cli?tab=readme-ov-file#installation) y en la sección de instalacion te dira los pasos a realizar dependiendo de tu sistema operativo y consola utilizada.

* Para confirmar que se instalo el cliente en tu proyecto (debes instarlo en la ruta del proyecto el paso anterior) ve al directorio de tu proyecto y debes encontrar un archivo con el nombre **auth0.exe** eso te indicara que se realizo la instalación correctamente.

* El CLI lo necesitamos para autenticarnos en nuestra cuenta de auth0 desde el proyecto con el siguiente comando:
````
.\auth0 login
````

* Sigue los pasos para logearte en el servicio y poder continuar, te debe arrojar un mensaje la consola como "Successfully logged in", ahora debemos correr los 2 siguientes comandos:
````
.\auth0 apps create --name "My Laravel Auth0 Application" --type "regular" --auth-method "post" --callbacks "http://localhost:8000/callback"  --logout-urls "http://localhost:8000" --reveal-secrets --no-input --json > .auth0.app.json



.\auth0 apis create --name "My Laravel Auth0 Application's API" --identifier "https://github.com/auth0/laravel-auth0" --offline-access --no-input --json > .auth0.api.json
````

* La parte de los comandos anteriores despues de --name es como se registraran en tu cuenta de auth0  la app y la api, puedes cambiar el nombre si lo deseas (solo lo que esta entre comillas despues de **--name**)

* Ahora debes encontrar en tu directorio del proyecto 2 nuevos archivos con extension .json (.auth0.api.json y .auth0.app.json)

* Estos 2 archivos contienen informacion confidencias y no deberian estar en ningun repositorio, por lo que deberias agregarlos a tu archivo **.env** (yo los dejo para proposito del proyecto pero los eliminare de mi cuenta por lo que no funcionarán, tendras que realizar estos pasos para tener tus archivos propios.)

* Los puedes agregar directamente a tu archivo .env desde consola con el siguiente comando o solo abre el archivo y agregalos (.auth0.*.json):
````
echo ".auth0.*.json" >> .gitignore
````

* Por ultimo puedes probar el funcionamiento agrewgando una ruta en tu archivo **web.php** como en este ejemplo:
````
Route::get('/private', function () {
    return response('welcome!! You are logged in.');
}) -> middleware('auth');
````

* En tu archivo .env valida que tengas la siguiente linea tal como aqui:
````
APP_URL=http://localhost:8000
````
* Ahora si podemos probar nuestra aplicación levantando el servicio con el comando:
````
php artisan serve
````

* abrimos el navegador en la ruta http://localhost:8000 y debemos ver a demás de la documentación el boton de **Log in** (debe mostrarte las opciones de iniciar sesión, registrarte y recuperar contraseña)

* Prueba que en la ruta http://localhost:8000/logout te saque de tu sesión y sin la sesión iniciada ve a la ruta: http://localhost:8000/private y te debe pedir tus credenciales antes de acceder


## Otras configuraciones

*** ojo, recuerda configurar tus variables de entorno de la base de datos en el archivo .env antes de las siguientes lineas de comando

* En este punto debes tener corriendo tu base de datos ya sea MySQL con Xampp o el que tu prefieras

* En este ejemplo vamos a utilizar la base de datos **techzone**


* crear una tabla por medio de migrate (en este ejemplo la tabla users)
```
php artisan make:migration create_users_table
```

*  en tu proyecto en la ruta database --> migrations debe estar el archivo creado (por lo regular el nombre inicia con la fecha del dia en que se creo). vamos agregar los siguientes campos:
```
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

```

* Migrar la base de datos 
```
php artisan migrate
```

* Rollback a migracion la base de datos (solo en caso de que algo saliera mal o faltara algun campo en la tabla, etc.)
```
php artisan migrate:rollback
```

* Ahora hay que crear los formularios en html y su logica para el inicio de sesion con usuarios desde la base de datos.

* Recuerda que este proyecto se inicio en un equipo con windows 10, para linux y Mac pudieran variar algunos pasos o necesitar algunos directorios permisos de lectura y escritura.

* Desde aqui creo que ya puedes crear rutas, vistas y estilos, ya queda a tu consideracion el resto del proyecto.







