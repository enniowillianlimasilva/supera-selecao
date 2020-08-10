@extends('layouts.app')

@section('content')
    @include('users.partials.header', [
        'title' => __('Usuários'),
        'description' => __(''),
        'class' => 'col-lg-7'
    ])   
    
    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">                    
                    <div class="card-body">
                        <form method="post" action="{{route('usuarios.update',$usuario->id)}}" enctype="multipart/form-data">
                            @method('put')
                            @csrf                           
                            <h6 class="heading-small text-muted mb-4">{{ __('Dados da Empresa') }}</h6>
                            
                                <div class="pl-lg-4">

                                <div class="form-group{{ $errors->has('unidade_id') ? ' has-danger' : '' }}">
                                    
                                        <label class="form-control-label" for="input-unidade_id">{{ __('Unidade') }}</label>
                                        <select  name="unidade_id" id="unidade_id" class="form-control form-control-alternative{{ $errors->has('unidade_id') ? ' is-invalid' : '' }}">
                                        @foreach($unidades as $unidade)
                                            @if($usuario->unidade_id == $unidade->id)
                                                <option value="{{$usuario->unidade_id}}" selected>{{$usuario->unidade->nome}}</option>
                                            @else
                                                <option value="{{$unidade->id}}">{{$unidade->nome}}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                </div>

                                <div class="form-group{{ $errors->has('cpf') ? ' has-danger' : '' }}">
                                    
                                    <label class="form-control-label" for="input-cnpj">{{ __('CPF') }}</label>
                                    <input type="text" name="cpf" id="cpf" class="form-control form-control-alternative{{ $errors->has('cpf') ? ' is-invalid' : '' }}"  value="{{ $usuario->cpf }}">

                                    @if ($errors->has('cpf'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('cpf') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('nome') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Nome') }}</label>
                                    <input type="text" name="nome" id="input-nome" class="form-control form-control-alternative{{ $errors->has('nome') ? ' is-invalid' : '' }}" value="{{ $usuario->nome }}">

                                    @if ($errors->has('nome'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nome') }}</strong>
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
        @include('layouts.footers.auth')
    </div>
@endsection

@section('bottomscripts')

@endsection

