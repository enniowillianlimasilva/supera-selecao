@extends('layouts.app')

@section('content')
    @include('users.partials.header', [
        'title' => __('Contratos'),
        'description' => __(''),
        'class' => 'col-lg-7'
    ])   

<div class="container-fluid mt--7">

        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-3">
                                <h3 class="mb-0">Lista de Contratos</h3>
                                
                            </div>
                            <div class="col-7">
                                <form class="form-row" action="" method="get">
                                    <div class="col-md-10"><input type="text" class="form-control form-control-sm" name="busca" id="busca"></div>
                                    <div class="col-md-2"><input class="btn btn-sm btn-primary" type="submit" value="Buscar"></div>
                                </form>
                            </div>
                            
                            <div class="col-2 text-right">
                                                            
                                <a href="{{route('contratos.create')}}" class="btn btn-sm btn-success">Adicionar</a>                           
                            </div>
                        </div>
                        @include('mensagens.sucesso')
                                               
                    </div>
                    
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Empresa</th>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Início</th>
                                    <th scope="col">Fim</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contratos as $contrato)
                                <tr>
                                    
                                    <td>{{$contrato->empresa->nome_fantasia}}</td>
                                    <td>{{$contrato->descricao}}</td>
                                    <td>{{$contrato->data_inicio}}</td>
                                    <td>{{$contrato->data_fim}}</td>

                                    <td>
                                        @if($contrato->status==1)
                                            <span class="badge badge-success">Ativo</span>
                                        @else   
                                            <span class="badge badge-danger">Inativo</span>
                                        @endif                                        
                                    </td>
                                    <td>
                                        <form action="{{ route('contratos.destroy',$contrato->id) }}" method="POST">
                                            
                                            <a class="btn btn-sm btn-info" href="{{ route('contratos.show',$contrato->id) }}">Visualizar</a>
                                            <a class="btn btn-sm btn-primary" href="{{ route('contratos.edit',$contrato->id) }}">Editar</a>
                                                                       
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
                    <div class="card-footer justify-content-center">{{$contratos->links()}}</div>
                </div>
            </div>
            
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

