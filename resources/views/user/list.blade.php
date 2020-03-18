@extends('templates.master')

@section('css-view')
@endsection

@section('js-view')
@endsection

@section('conteudo-view')
    @include('templates.others.title', [ 'title' => 'Gerenciamento de Usuários' ])

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

