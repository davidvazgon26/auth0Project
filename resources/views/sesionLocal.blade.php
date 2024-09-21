<!DOCTYPE html>

<!-- este archivo se creo con click derecho y crear archivo y se agrego este codigo: -->

<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Inicio de Sesión</h2>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Se necesita definir la ruta del navegador (como ej. {{ route('login') }}) y a que metodo del controlador debe ir en el archivo web.php -->
    <form method="POST" action="{{ route('loginLocal') }}">
        @csrf
        <div>
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" value="{{ old('username') }}" required>
        </div>

        <div>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <button type="submit">Iniciar Sesión</button>
        </div>
    </form>


</body>
</html>
