@extends('templates.master')

@section('css-view')
@endsection

@section('js-view')
@endsection

@section('conteudo-view')
    @include('templates.others.title', [ 'title' => 'Gerenciamento de Usuários' ])

    <table cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <td>ID</td>
                <td>Nome</td>
                <td>Telefone</td>
                <td>Nível de Acesso</td>
                <td></td>
                <td></td>
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
                    <td><a href="{{ route('user.edit', $row->id ) }}">Editar</a></td>
                    <td><a href="{{ route('user.upgrade', $row->id ) }}">upgrade</a></td>
                    {{-- <td>
                        {!! Form::open(['route' => ['user.upgrade', $row->id], 'method' => 'POST']) !!}
                            {!! Form::submit('upgrade', [ 'class' => 'btn-remove']) !!}
                        {!! Form::close() !!}
                    </td> --}}
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

