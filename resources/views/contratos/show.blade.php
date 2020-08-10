@extends('layouts.app')

@section('content')
    @include('users.partials.header', [
        'title' => __('Contrato'),
        'description' => __(''),
        'class' => 'col-lg-7'
    ])   
    
    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">                    
                    <div class="card-body">
                                                
                            <h6 class="heading-small text-muted mb-4">{{ __('Dados do Contrato') }}</h6>
                            
                                <div class="pl-lg-4">

                                <div class="form-group{{ $errors->has('empresa_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-empresa_id">{{ __('Empresa') }}</label>
                                    <select name="empresa_id" id="empresa_id_select2" class="form-control form-control-alternative{{ $errors->has('empresa_id') ? ' is-invalid' : '' }}" readonly>
                                        
                                        @foreach($empresas as $empresa)
                                            @if ($contrato->empresa_id != $empresa->id)
                                                <option value="{{ $empresa->id}}">{{ $empresa->nome_fantasia }}</option>
                                            @else
                                                <option value="{{ $empresa->id}}" selected>{{ $empresa->nome_fantasia }}</option>
                                            @endif    
                                        
                                        @endforeach
                                    </select>
                                    
                                    @if ($errors->has('empresa_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('empresa_id') }}</strong>
                                        </span>
                                    @endif

                                </div>

                                <div class="form-group{{ $errors->has('descricao') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Descrição') }}</label>
                                    <input type="text" name="descricao" id="input-descricao" class="form-control form-control-alternative{{ $errors->has('descricao') ? ' is-invalid' : '' }}" value="{{ $contrato->descricao }}" readonly>

                                    @if ($errors->has('descricao'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('descricao') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('data_inicio') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-data_inicio">{{ __('Início') }}</label>
                                    <input type="date" name="data_inicio" id="input-data_inicio" class="form-control form-control-alternative{{ $errors->has('data_inicio') ? ' is-invalid' : '' }}" value="{{ $contrato->data_inicio }}" readonly>

                                    @if ($errors->has('data_inicio'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('data_inicio') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('data_fim') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-data_fim">{{ __('Término') }}</label>
                                    <input type="date" name="data_fim" id="input-data_fim" class="form-control form-control-alternative{{ $errors->has('data_fim') ? ' is-invalid' : '' }}" value="{{ $contrato->data_fim }}" readonly>

                                    @if ($errors->has('data_fim'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('data_fim') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-status">{{ __('Status') }}</label>
                                    <select name="status" id="input-status" class="form-control form-control-alternative{{ $errors->has('status') ? ' is-invalid' : '' }}" readonly>
                                        
                                        @if ($contrato->status==1)
                                            <option value="1" selected>Ativo</option>
                                            <option value="0">Inativo</option>
                                    
                                        @else
                                            <option value="1">Ativo</option>
                                            <option value="0" selected>Inativo</option>
                                        @endif
                                        
                                    </select>

                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <label class="form-control-label">Unidades</label>
                                    </div>
                                    <div class="card-body">
                                        <ul>
                                        @foreach($contrato->empresa->unidades as $unidade)
                                        
                                         <div class="row">
                                         <div class="col-6"><input type="text" class="form-control" value="{{$unidade->nome}}" readonly> </div>
                                         <div class="col-6"><a class="btn btn-primary" href="{{url('unidades/' . $unidade->id . '/usuarios')}}">Adicionar usuário</a></div>
                                         
                                        </div>
                                        @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <div class="text-center">
                                    
                                    <a href="{{ url()->previous() }}" class="btn btn-default mt-4">Voltar</a>
                                </div>
                            </div>
                                                           
                    </div>                    
                </div>
            </div>            
        </div>
        <script src="{{ asset('js/preview.js') }}" defer></script>
        <script src="{{ asset('js/custom.js') }}" defer></script>
                
        @include('layouts.footers.auth')
    </div>
@endsection

@section('bottomscripts')

@endsection

