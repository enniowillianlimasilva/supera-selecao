<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContratoRequest;
use App\Contrato;
use App\Empresa;

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['busca'])){
            $busca = $_GET['busca'];
            $contratos = Contrato::orderBy('descricao', 'asc')
                        ->where('descricao', 'like', '%' . $busca . '%')
                        ->paginate(5);
        }else{
            $contratos = Contrato::orderBy('descricao', 'asc')->paginate(5);
        }

        return view('contratos.index',compact('contratos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $empresas = Empresa::where('status',1)->get();

        return view('contratos.create',compact('empresas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContratoRequest $request)
    {
        $contrato = new Contrato();

        $contrato->empresa_id = $request->empresa_id;
        $contrato->descricao = $request->descricao;
        $contrato->data_inicio = $request->data_inicio;
        $contrato->data_fim = $request->data_fim;
        $contrato->status = $request->status;

        $contrato->save();

        return redirect()->route('contratos.index')
        ->with('sucesso', 'Contrato cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contrato = Contrato::findOrFail($id);
        $empresas = Empresa::where('status',1)->get();
        return view('contratos.show',compact('contrato','empresas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        $contrato = Contrato::findOrFail($id);
        $empresas = Empresa::where('status',1)->get();
        return view('contratos.edit',compact('contrato','empresas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContratoRequest $request, $id)
    {
        $contrato = Contrato::find($id);

        $contrato->empresa_id = $request->empresa_id;
        $contrato->descricao = $request->descricao;
        $contrato->data_inicio = $request->data_inicio;
        $contrato->data_fim = $request->data_fim;
        $contrato->status = $request->status;

        $contrato->save();

        return redirect()->route('contratos.index')
        ->with('sucesso', 'Contrato atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contrato = Contrato::findOrFail($id);
        $contrato->delete();

        return redirect()->route('contratos.index')
        ->with('sucesso', 'Contrato excluído com sucesso!');

    }
}
