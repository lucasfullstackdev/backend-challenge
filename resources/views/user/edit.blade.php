@extends('templates.master')

@section('css-view')
@endsection

@section('js-view')
@endsection

@section('conteudo-view')
    @include('templates.others.title', [ 'title' => 'Atualizar usuário' ])
    {!! Form::model( $user, [ 'route' => ['user.update', $user->id], 'method' => 'put' ]) !!}

        @include('templates.form.form-fields')
        @include('templates.form.submit', ['input' => 'Atualizar'])

    {!! Form::close() !!}
@endsection

