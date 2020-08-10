@extends('layouts.app')

@section('content')
    @include('users.partials.header', [
        'title' => __('Usuários'),
        'description' => __($unidade->nome),
        'class' => 'col-lg-7'
    ])   

<div class="container-fluid mt--7">

        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-3">
                            <h3 class="mb-0">Lista de Usuários</h3>
                                
                            </div>
                            <div class="col-7">
                                <form class="form-row" action="" method="get">
                                    <div class="col-md-10"><input type="text" class="form-control form-control-sm" name="busca" id="busca"></div>
                                    <div class="col-md-2"><input class="btn btn-sm btn-primary" type="submit" value="Buscar"></div>
                                </form>
                            </div>
                            
                            <div class="col-2 text-right">
                                                            
                            <a href="{{url('unidades/' . $unidade->id . '/usuarios/create')}}" class="btn btn-sm btn-success">Adicionar</a>                           
                            </div>
                        </div>
                        @include('mensagens.sucesso')
                                               
                    </div>
                    
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                   
                                    <th scope="col">CPF</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($usuarios as $usr)
                                <tr>
                                    <td>{{$usr->cpf}}</td>
                                    <td>{{$usr->nome}}</td>
                                    
                                    <td>
                                        <form action="{{ route('usuarios.destroy',$usr->id) }}" method="POST">
   
                                            <a class="btn btn-sm btn-info" href="{{ url('unidades/' . $unidade->id . '/usuarios/' . $usr->id .'/atestados') }}">Atestados</a>
                            
                                            <a class="btn btn-sm btn-primary" href="{{ route('usuarios.edit',$usr->id) }}">Editar</a>
                           
                                            @csrf
                                            @method('DELETE')
                              
                                            <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer justify-content-center">{{$usuarios->links()}}</div>
                </div>
            </div>
            
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

