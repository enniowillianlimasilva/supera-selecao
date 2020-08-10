@extends('layouts.app')

@section('content')
    @include('users.partials.header', [
        'title' => __('Unidades'),
        'description' => __(''),
        'class' => 'col-lg-7'
    ])   
    
    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">                    
                    <div class="card-body">
                        <form method="post" action="{{ route('unidades.update',$unidade->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Dados da Unidade') }}</h6>
                            
                                <div class="pl-lg-4">
                                
                                
                                <div class="form-group">
                                    @include('mensagens.logo')
                                </div>

                                <div class="form-group{{ $errors->has('logomarca') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-logomarca">{{ __('Logomarca') }}</label>
                                    <img src="{{ url("storage/{$unidade->logomarca}")}}" onClick="triggerClick()" alt="" id="profileDisplay">
                                    
                                </div>
                    
                                <div class="form-group">				
                                    <input class="form-control" type="file" onChange="displayImage(this)" name="logomarca" id="logomarca" style="display: none;">
                                    
                                </div>

                                <div class="form-group{{ $errors->has('empresa_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-empresa_id">{{ __('Empresa') }}</label>
                                    <select name="empresa_id" id="empresa_id" class="form-control form-control-alternative{{ $errors->has('empresa_id') ? ' is-invalid' : '' }}" value="{{ old('empresa_id') }}" >
                                        @foreach($empresas as $empresa)
                                            @if($unidade->empresa_id == $empresa->id)
                                                <option value="{{ $empresa->id}}" selected>{{ $empresa->nome_fantasia }}</option>
                                            @else
                                                <option value="{{ $empresa->id}}">{{ $empresa->nome_fantasia }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    
                                    @if ($errors->has('estado_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('estado_id') }}</strong>
                                        </span>
                                    @endif

                                </div>

                                <div class="form-group{{ $errors->has('nome') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Nome da Unidade') }}</label>
                                    <input type="text" name="nome" id="input-nome" class="form-control form-control-alternative{{ $errors->has('nome') ? ' is-invalid' : '' }}" value="{{ $unidade->nome }}">

                                    @if ($errors->has('nome'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nome') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('estado_id') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-name">{{ __('Estado') }}</label>
                                            <select name="estado_id" id="estado_id" class="form-control form-control-alternative{{ $errors->has('estado_id') ? ' is-invalid' : '' }}">
                                                
                                                @foreach($estados as $estado)
                                                    @if($unidade->estado_id== $estado->id)    
                                                        <option value="{{ $estado->id}}" selected>{{ $estado->uf }}</option>
                                                    @else
                                                        <option value="{{ $estado->id}}">{{ $estado->uf }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            
                                            @if ($errors->has('estado_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('estado_id') }}</strong>
                                                </span>
                                            @endif
        
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('cidade_id') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-name">{{ __('Cidade') }}</label>
                                            <select name="cidade_id" id="cidade_id" class="form-control form-control-alternative{{ $errors->has('cidade_id') ? ' is-invalid' : '' }}" >
                                            <option value="{{$unidade->cidade_id}}">{{$unidade->cidade->nome}}</option>
                                                
                                            </select>
        
                                            @if ($errors->has('cidade_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('cidade_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                

                                
                                
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $unidade->email }}" >

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('tipo') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-status">{{ __('Tipo') }}</label>
                                    <select name="tipo" id="input-tipo" class="form-control form-control-alternative{{ $errors->has('tipo') ? ' is-invalid' : '' }}">
                                        @if($unidade->tipo==0) 
                                            <option value="0" selected>Json</option>
                                            <option value="1">WebView</option>
                                            <option value="2">XML</option>
                                            <option value="3">HL7</option>
                                        @endif
                                        @if($unidade->tipo==1) 
                                            <option value="0" >Json</option>
                                            <option value="1" selected>WebView</option>
                                            <option value="2">XML</option>
                                            <option value="3">HL7</option>
                                        @endif
                                        @if($unidade->tipo==2) 
                                            <option value="0" selected>Json</option>
                                            <option value="1">WebView</option>
                                            <option value="2" selected>XML</option>
                                            <option value="3">HL7</option>
                                        @endif
                                        @if($unidade->tipo==3) 
                                            <option value="0" selected>Json</option>
                                            <option value="1">WebView</option>
                                            <option value="2">XML</option>
                                            <option value="3" selected>HL7</option>
                                        @endif
                                        
                                        
                                    </select>

                                    @if ($errors->has('tipo'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('tipo') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-status">{{ __('Status') }}</label>
                                    <select name="status" id="input-status" class="form-control form-control-alternative{{ $errors->has('status') ? ' is-invalid' : '' }}">
                                        @if($unidade->status==1)
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

