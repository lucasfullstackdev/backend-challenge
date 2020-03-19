<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    @yield('css-view')

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/stylesheet.css') }}">

    <title>Document</title>
</head>
<body>
    <section id="conteudo-view" class="fullscren">
        
        {!! Form::open([ 'route' => 'user.store', 'method' => 'post' ]) !!}
            @include('templates.form.form-fields')
            @include('templates.form.submit', ['input' => 'Cadastrar'])
        {!! Form::close() !!}
        
        {!! Form::open(['route' => ['user.login'], 'method' => 'GET']) !!}
            <label>
                {!! Form::submit('Voltar', [ 'class' => 'bg-danger']) !!}
            </label>
        {!! Form::close() !!}
        
    </section>

    @yield('js-view')
</body>
</html>