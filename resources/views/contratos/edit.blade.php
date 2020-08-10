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
                        <form method="post" action="{{ route('contratos.update',$contrato->id) }}" enctype="multipart/form-data">
                            @method('put')
                            @csrf                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Dados do Contrato') }}</h6>
                            
                                <div class="pl-lg-4">

                                <div class="form-group{{ $errors->has('empresa_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-empresa_id">{{ __('Empresa') }}</label>
                                    <select name="empresa_id" id="empresa_id_select2" class="form-control form-control-alternative{{ $errors->has('empresa_id') ? ' is-invalid' : '' }}">
                                        
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
                                    <input type="text" name="descricao" id="input-descricao" class="form-control form-control-alternative{{ $errors->has('descricao') ? ' is-invalid' : '' }}" value="{{ $contrato->descricao }}">

                                    @if ($errors->has('descricao'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('descricao') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('data_inicio') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-data_inicio">{{ __('Início') }}</label>
                                    <input type="date" name="data_inicio" id="input-data_inicio" class="form-control form-control-alternative{{ $errors->has('data_inicio') ? ' is-invalid' : '' }}" value="{{ $contrato->data_inicio }}">

                                    @if ($errors->has('data_inicio'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('data_inicio') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('data_fim') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-data_fim">{{ __('Término') }}</label>
                                    <input type="date" name="data_fim" id="input-data_fim" class="form-control form-control-alternative{{ $errors->has('data_fim') ? ' is-invalid' : '' }}" value="{{ $contrato->data_fim }}">

                                    @if ($errors->has('data_fim'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('data_fim') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-status">{{ __('Status') }}</label>
                                    <select name="status" id="input-status" class="form-control form-control-alternative{{ $errors->has('status') ? ' is-invalid' : '' }}">
                                        
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
        <script src="{{ asset('js/preview.js') }}" defer></script>
        <script src="{{ asset('js/custom.js') }}" defer></script>
                
        @include('layouts.footers.auth')
    </div>
@endsection

@section('bottomscripts')

@endsection

