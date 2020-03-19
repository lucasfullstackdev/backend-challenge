@extends('templates.master')

@section('css-view')
@endsection

@section('js-view')
@endsection

@section('conteudo-view')
    @include('templates.others.title', [ 'title' => 'Cadastro de usuário' ])
    
    {!! Form::open([ 'route' => 'user.store', 'method' => 'post', 'class' => 'form-padrao']) !!}
        @include('templates.form.form-fields')
        @include('templates.form.submit', ['input' => 'Cadastrar'])
    {!! Form::close() !!}

    @if(session('success'))
        <h3>{{ session('success')['message'] }}</h3>
    @endif

@endsection

