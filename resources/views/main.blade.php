<h1>Mi principal</h1>

<!-- <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Cerrar Sesión</button>
</form> -->

<form action="{{ route('logout') }}" method="GET">
    @csrf
    <button type="submit">Cerrar Sesión Auth0</button>
</form>