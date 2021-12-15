@php
use Illuminate\Support\Facades\Auth;
use App\Models\Type_user;
try {
    $current_user = Auth::user();
} catch (\Throwable $th) {
    route('login');
}
@endphp
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Embarques</title>
</head>

<body>
    <header class="div-header">
        <div> <img src="{{ asset('images/logo-branca.png') }}" alt="" width="48px" style="margin-left: 10px"></div>
        <ul>
            @if (Auth::check() === true)  <li> <a href="{{ route('boarding.create') }}"> Cadastrar embarque</a></li> @endif
            <li> <a href="{{ route('boarding.index') }}"> Embarques em Andamento </a> </li>
            <li> <a href="{{ route('finish') }}"> Embarques Finalizados </a> </li>
        </ul>
    <div>
            @if (Auth::check() === true) 
            <a class="login-btn" href="{{ route('logout') }}"> Sair</a>
            @else
                <a class="login-btn" href="{{ route('login') }}"> Entrar </a>
            @endif
        </div>
    </header>
    @yield('content')


</body>

</html>
