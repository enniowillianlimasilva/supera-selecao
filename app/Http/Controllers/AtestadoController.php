<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AtestadoRequest;
use App\Usuario;
use App\Atestado;

class AtestadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($unidadeId,$usuarioId)
    {
        $usuario = Usuario::find($usuarioId);
        $atestados = Atestado::where('usuario_id',$usuario->id)->get();
       

        return view('atestados.index',compact('usuario','atestados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$unidadeId,$usuarioId)
    {
        
        $usuario = Usuario::findOrFail($usuarioId);
        $rota = 'unidades/' . $usuario->unidade_id .'/usuarios/' . $usuario->id .'/atestados/';
        Atestado::where('usuario_id',$usuario->id)->delete();
        $itens = $request->all();

        if(isset($itens['group-atestados']) and ($itens['group-atestados'][0]['data_entrega']!=null) and  ($itens['group-atestados'][0]['tipo']!=null)){
            $quantidade = count($itens['group-atestados']);

            if($quantidade>0){

                for($i=0;$i<$quantidade;$i++){
                    
                    $atestado = new Atestado();
                    $atestado->usuario_id = $usuario->id;
                    $atestado->data_entrega = $itens['group-atestados'][$i]['data_entrega'];;
                    $atestado->tipo = $itens['group-atestados'][$i]['tipo'];
                    
                    $atestado->save();
                }
            }
        }else{
            return redirect($rota)
            ->with('aviso', 'É necessário inserir o(s) atestado(s)');
        }
        
        return redirect($rota)
        ->with('sucesso', 'Atestado(s) cadastrado(s) com sucesso!');

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
