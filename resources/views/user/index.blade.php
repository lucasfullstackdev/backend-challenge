@extends('templates.master')

@section('css-view')
@endsection

@section('js-view')
@endsection

@section('conteudo-view')
    @include('templates.others.title', [ 'title' => 'Cadastro de usuário' ])
    {!! Form::open([ 'route' => 'user.store', 'method' => 'post', 'class' => 'form-padrao']) !!}

        @include('templates.form.input', ['label' => 'Nome', 'input' => 'name', 'attributes'=> ['placeholder' => 'Nome Completo']])
        @include('templates.form.input', ['label' => 'Celular', 'input' => 'msisdn', 'attributes'=> ['placeholder' => 'ex: +55999999999']])
        @include('templates.form.select', ['label' => 'Nível de Acesso', 'input' => 'access_level' ])
        @include('templates.form.password', ['label' => 'Senha', 'input' => 'password', 'attributes'=> ['required' => true ]])
        @include('templates.form.submit', ['input' => 'Cadastrar'])

    {!! Form::close() !!}

    @if(session('success'))
        <h3>{{ session('success')['message'] }}</h3>
    @endif

    <table>
        <thead>
            <tr>
                <td>ID</td>
                <td>Nome</td>
                <td>Telefone</td>
                <td>Nível de Acesso</td>
                <td></td>
            </tr>
        </thead>

        <tbody>

                @foreach ($users as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->formatted_msisdn }}</td>
                    <td>{{ $row->access_level }}</td>
                    <td>
                        {!! Form::open(['route' => ['user.destroy', $row->id], 'method' => 'DELETE']) !!}
                            {!! Form::submit('Remover', [ 'class' => 'btn-remove']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach

        </tbody>
    </table>



@endsection

