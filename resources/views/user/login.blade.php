<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/stylesheet.css') }}">

    <title>Login - User Management</title>
</head>
<body>
    <section id="main-view" class="login">
        <section id="main-view-container">

            {!! Form::open(['route' => 'user.login', 'method' => 'post']) !!}
            
            <h2>Acesse o sistema</h2>
            <label>
                {!! Form::text('username', null, ['class' => 'input', 'placeholder' => 'Celular']) !!}
            </label>
            
            {!! Form::password('password', ['placeholder' => 'Senha']) !!}
            
            {!! Form::submit('Entrar') !!}
            
            <div>
                {!! link_to_route( 'user.recuperar-senha', 'esqueci minha senha' ) !!}
            </div>

            {!! Form::close() !!}
            
        </section>
    </section>
</body>
</html>