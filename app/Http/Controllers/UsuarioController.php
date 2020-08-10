<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unidade;
use App\Usuario;
use App\Http\Requests\UsuarioRequest;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $unidade = Unidade::find($id);

        if(isset($_GET['busca'])){
            $busca = $_GET['busca'];
            $usuarios = Usuario::orderBy('nome', 'asc')
                        ->where('unidade_id', $unidade->id)
                        ->where('nome', 'like', '%' . $busca . '%')
                        ->paginate(5);
        }else{
            $usuarios = Usuario::orderBy('nome')->where('unidade_id',$id)->paginate(5);
        }

        return view('usuarios.index',compact('unidade','usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $unidade = Unidade::find($id);
        return view('usuarios.create',compact('unidade'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRequest $request)
    {
        $usuario = new Usuario();

        $usuario->unidade_id = $request->unidade_id;
        $usuario->cpf = $request->cpf;
        $usuario->nome = $request->nome;

        $usuario->save();

        return redirect('unidades/' . $usuario->unidade_id . '/usuarios')
        ->with('sucesso', 'Usuário cadastrado com sucesso!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $usuario = Usuario::findOrFail($id);
        $unidades = Unidade::all();
        return view('usuarios.edit',compact('usuario','unidades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsuarioRequest $request, $id)
    {
        $usuario = Usuario::find($id);

        $usuario->unidade_id = $request->unidade_id;
        $usuario->cpf = $request->cpf;
        $usuario->nome = $request->nome;

        $usuario->save();

        return redirect('unidades/' . $usuario->unidade_id . '/usuarios')
        ->with('sucesso', 'Usuário atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect('unidades/' . $usuario->unidade_id . '/usuarios')
        ->with('sucesso', 'Usuário excluído com sucesso!');
    }
}
