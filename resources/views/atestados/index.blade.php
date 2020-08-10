@extends('layouts.app')

@section('content')
    @include('users.partials.header', [
        'title' => __('Atestados'),
        'description' => __('Usuário: ' . $usuario->nome),
        'class' => 'col-lg-7'
    ])   
    
    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">                    
                    <div class="card-body">
                        <form method="post" action="{{url('unidades/'. $usuario->unidade_id . '/usuarios/' . $usuario->id .'/atestados/store')}}" enctype="multipart/form-data">
                            @csrf                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Dados do Atestado') }}</h6>

                                @include('mensagens.sucesso')
                                @include('mensagens.erro')
                                @include('mensagens.aviso')
                                <div class="pl-lg-4">
                                
                                    <div class="repeater noConflict">
                                        <div data-repeater-list="group-atestados">
                                            <input class="btn btn-success" data-repeater-create type="button" value="Adicionar atestado"/>
                                            @foreach ($atestados as $atestado)
                                                <div data-repeater-item class="row mt-4">
                                                    <div class="col-sm-5">
                                                        
                                                    <input type="date" name="data_entrega" id="data_entrega" class="form-control" value="{{$atestado->data_entrega}}">
                                                    </div>
                                                    <div class="col-sm-3" align="left">
                                                        
                                                        <select class="form-control" name="tipo" id="tipo">
                                                            @if ($atestado->tipo == 1)
                                                                <option value="1" selected>Paciente</option>
                                                                <option value="2">Acompanhante</option>
                                                                <option value="3">Óbito</option>
                                                            @endif
                                                            @if ($atestado->tipo == 2)
                                                                <option value="1">Paciente</option>
                                                                <option value="2" selected>Acompanhante</option>
                                                                <option value="3">Óbito</option>
                                                            @endif
                                                            @if ($atestado->tipo == 3)
                                                                <option value="1">Paciente</option>
                                                                <option value="2">Acompanhante</option>
                                                                <option value="3" selected>Óbito</option>
                                                            @endif
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4" align="left">
                                                        
                                                        <input class="btn btn-danger" data-repeater-delete type="button" value="Deletar"/>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div data-repeater-item class="row mt-4">
                                                <div class="col-sm-5">
                                                    
                                                    <input type="date" name="data_entrega" id="data_entrega" class="form-control">
                                                </div>
                                                <div class="col-sm-3" align="left">
                                                    
                                                    <select class="form-control" name="tipo" id="tipo">
                                                        <option value=""></option>
                                                        <option value="1">Paciente</option>
                                                        <option value="2">Acompanhante</option>
                                                        <option value="3">Óbito</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4" align="left">
                                                    
                                                    <input class="btn btn-danger" data-repeater-delete type="button" value="Deletar"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
   
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Salvar') }}</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-default mt-4">Voltar</a>
                                </div>
                            </div>
                        </form>                                        
                    </div>                    
                </div>
            </div>            
        </div>
        <script src="{{ asset('js/master-detail.js') }}" defer></script>
        @include('layouts.footers.auth')
    </div>
@endsection

@section('bottomscripts')
<script src="{{ asset('js/jquery-1.11.1.js') }}"></script>
<script src="{{ asset('js/jquery.repeater.js') }}"></script>

<script> 
    $('.repeater').repeater({
        show: function () {
            $(this).slideDown();
        },
        hide: function (deleteElement) {
            if(confirm('Tem certeza da exclusão')) {
                $(this).slideUp(deleteElement);
            }
        },
        ready: function (setIndexes) {

        }
    });

</script>
@endsection

