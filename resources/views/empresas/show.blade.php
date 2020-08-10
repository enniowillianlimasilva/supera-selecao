@extends('layouts.app')

@section('content')
    @include('users.partials.header', [
        'title' => __('Empresas'),
        'description' => __(''),
        'class' => 'col-lg-7'
    ])   
    
    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">                    
                    <div class="card-body">
                        
                            @method('put')  
                            @csrf                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Dados da Empresa') }}</h6>
                            
                                <div class="pl-lg-4">
                                
                                
                                <div class="form-group">
                                    @include('mensagens.logo')
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label" for="input-cnpj">{{ __('Logomarca') }}</label>
                                    <img src="{{ url("storage/{$empresa->logomarca}")}}" alt="" id="profileDisplay">
                                    
                                </div>
                    
                                <div class="form-group">				
                                    <input class="form-control" type="file" onChange="displayImage(this)" name="logomarca" id="logomarca" style="display: none;">
                                    
                                </div>
                                

                                <div class="form-group{{ $errors->has('cnpj') ? ' has-danger' : '' }}">
                                    
                                    <label class="form-control-label" for="input-cnpj">{{ __('CNPJ') }}</label>
                                    <input type="text" name="cnpj" id="cnpj" class="form-control form-control-alternative{{ $errors->has('cnpj') ? ' is-invalid' : '' }}"  value="{{ $empresa->cnpj }}" readonly>

                                    @if ($errors->has('cnpj'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('cnpj') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('razao_social') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-razao_social">{{ __('Razão Social') }}</label>
                                    <input type="text" name="razao_social" id="input-razao_social" class="form-control form-control-alternative{{ $errors->has('razao_social') ? ' is-invalid' : '' }}" value="{{ $empresa->razao_social }}" readonly>

                                    @if ($errors->has('razao_social'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('razao_social') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('nome_fantasia') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Nome Fantasia') }}</label>
                                    <input type="text" name="nome_fantasia" id="input-nome_fantasia" class="form-control form-control-alternative{{ $errors->has('nome_fantasia') ? ' is-invalid' : '' }}" value="{{ $empresa->nome_fantasia }}" readonly>

                                    @if ($errors->has('nome_fantasia'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nome_fantasia') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $empresa->email }}" readonly>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-status">{{ __('Status') }}</label>
                                    <select name="status" id="input-status" class="form-control form-control-alternative{{ $errors->has('status') ? ' is-invalid' : '' }}" readonly>
                                        @if($empresa->status==1)
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
                                    <a href="{{ url()->previous() }}" class="btn btn-default mt-4">Voltar</a>
                                </div>
                            </div>
                                                                
                    </div>                    
                </div>
            </div>            
        </div>
        <script src="{{ asset('js/preview.js') }}" defer></script>
        @include('layouts.footers.auth')
    </div>
@endsection

@section('bottomscripts')

@endsection

