@extends('store.account.index')

    @section('data')

            <h3>Dados de Entrega</h3>

            <div class="col-lg-10">
            @if (session('address_exist'))
                <div class="alert alert-danger">
                    {{ session('address_exist') }}
                </div>
            @endif
            @if(!count($address))
                <div class="alert alert-info">Endereço não cadastrado, Por favor <a href="{{ route('account_address_new') }}" title="" class="btn-link">cadastre-se</a></div>
            @else
            <table class="table">
                <tbody>
                <tr>
                    <th>Rua</th>
                    <th>Cidade</th>
                    <th>CEP</th>
                    <th>Estado</th>
                    <th>País</th>
                    <th>Opção</th>
                </tr>
                @forelse($address as $addr)
                <tr>
                    <td>{{ $addr->street }}</td>
                    <td>{{ $addr->city }}</td>
                    <td>{{ $addr->zip_code }}</td>
                    <td>{{ $addr->state }}</td>
                    <td>{{ $addr->country }}</td>
                    <td><a href="{{ route('account_address_edit', ['id' => $addr->id]) }}" title="Editar" class="btn btn-sm btn-success">Alterar</a>
                    <a href="{{ route('account_address_destroy', ['id' => $addr->id]) }}" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="4"><h2>Endereço não cadastrado, Por favor <a href="{{ route('account_address_new') }}" title="" class="btn-link">cadastre-se</a></h2></td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            @endif
            </div>
@stop