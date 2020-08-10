<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unidade;
use App\Empresa;
use App\Estado;
use App\Usuario;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UnidadeRequest;
use App\Http\Requests\UnidadeUpdateRequest;

class UnidadeController extends Controller
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
            $unidades = Unidade::orderBy('nome', 'asc')
                        ->where('nome', 'like', '%' . $busca . '%')
                        ->orWhere('email', 'like', '%' . $busca . '%')
                        ->paginate(5);
        }else{
            $unidades = Unidade::orderBy('nome', 'asc')->paginate(5);
        }

        return view('unidades.index',compact('unidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresas = Empresa::orderBy('nome_fantasia', 'asc')
                            ->where('status', '=', '1')->get();
        
        $estados = Estado::all();

        return view('unidades.create',compact('empresas','estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnidadeRequest $request)
    {
        $unidade = new Unidade();

        $unidade->empresa_id = $request->empresa_id;
        $unidade->nome = $request->nome;
        $unidade->estado_id = $request->estado_id;
        $unidade->cidade_id = $request->cidade_id;
        $unidade->email = $request->email;
        $unidade->tipo = $request->tipo;
        $unidade->status = $request->status;
        
        if ($request->hasFile('logomarca') && $request->file('logomarca')->isValid()) {
         
            $name = uniqid(date('HisYmd'));
            $extension = $request->logomarca->extension();
            $nameFile = "{$name}.{$extension}";

            $upload = $request->logomarca->storeAs('unidades', $nameFile);

            if ( !$upload )
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer upload')
                            ->withInput();
            
            $unidade->logomarca = $upload;
     
        }

        
        $unidade->save();

        return redirect()->route('unidades.index')
        ->with('sucesso', 'Unidade cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unidade = Unidade::find($id);
        $usuarios = Usuario::orderBy('nome')->where('unidade_id',$id)->paginate(10);

        return view('unidades.show',compact('unidade','usuarios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   

        $unidade = Unidade::findOrFail($id);

        $empresas = Empresa::orderBy('nome_fantasia', 'asc')
                            ->where('status', '=', '1')->get();
        
        $estados = Estado::all();

        return view('unidades.edit',compact('unidade','empresas','estados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UnidadeUpdateRequest $request, $id)
    {
        $unidade = Unidade::findOrFail($id);

        $unidade->empresa_id = $request->empresa_id;
        $unidade->nome = $request->nome;
        $unidade->estado_id = $request->estado_id;
        $unidade->cidade_id = $request->cidade_id;
        $unidade->email = $request->email;
        $unidade->tipo = $request->tipo;
        $unidade->status = $request->status;
        
        if ($request->hasFile('logomarca') && $request->file('logomarca')->isValid()) {
         
            $name = uniqid(date('HisYmd'));
            $extension = $request->logomarca->extension();
            $nameFile = "{$name}.{$extension}";

            $upload = $request->logomarca->storeAs('unidades', $nameFile);

            if ( !$upload )
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer upload')
                            ->withInput();
            
            $unidade->logomarca = $upload;
     
        }

        
        $unidade->save();

        return redirect()->route('unidades.index')
        ->with('sucesso', 'Unidade atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unidade = Unidade::findOrFail($id);
        if($unidade){
            $unidade->delete();
            return redirect()->route('unidades.index')
            ->with('sucesso', 'Unidade excluída com sucesso!');
        }
    }

    public function getCidades($id) {
        $cidades = DB::table("cidades")->where("id_estado",$id)->pluck("nome","id");
        return json_encode($cidades);
    }
}
