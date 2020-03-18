@extends('templates.master')

@section('css-view')
@endsection

@section('js-view')
@endsection

@section('conteudo-view')
    @include('templates.others.title', [ 'title' => 'Cadastro de usuário' ])
    {!! Form::open(['method' => 'post', 'class' => 'form-padrao']) !!}

        @include('templates.form.input', ['label' => 'Nome', 'input' => 'nane', 'attributes'=> ['placeholder' => 'Nome Completo']])
        @include('templates.form.input', ['label' => 'Celular', 'input' => 'msisdn', 'attributes'=> ['placeholder' => 'ex: +55999999999']])
        @include('templates.form.select', ['label' => 'Nível de Acesso', 'input' => 'access_level' ])
        @include('templates.form.password', ['label' => 'Senha', 'input' => 'password', 'attributes'=> ['required' => true ]])
        @include('templates.form.submit', ['input' => 'asdf'])

    {!! Form::close() !!}
@endsection

