<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmpresaRequest;
use App\Http\Requests\EmpresaUpdateRequest;
use App\Empresa;

class EmpresaController extends Controller
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
            $empresas = Empresa::orderBy('razao_social', 'asc')
                        ->where('razao_social', 'like', '%' . $busca . '%')
                        ->orWhere('nome_fantasia', 'like', '%' . $busca . '%')
                        ->orWhere('cnpj', 'like', '%' . $busca . '%')
                        ->paginate(5);
        }else{
            $empresas = Empresa::orderBy('razao_social', 'asc')->paginate(5);
        }

        return view('empresas.index',compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empresas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpresaRequest $request)
    {
        $empresa = new Empresa();

        $empresa->cnpj = $request->cnpj;
        $empresa->razao_social = $request->razao_social;
        $empresa->nome_fantasia = $request->nome_fantasia;
        $empresa->email = $request->email;
        $empresa->status = $request->status;
        
        if ($request->hasFile('logomarca') && $request->file('logomarca')->isValid()) {
         
            $name = uniqid(date('HisYmd'));
            $extension = $request->logomarca->extension();
            $nameFile = "{$name}.{$extension}";

            $upload = $request->logomarca->storeAs('empresas', $nameFile);

            if ( !$upload )
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer upload')
                            ->withInput();
     
        }

        $empresa->logomarca = $upload;
        $empresa->save();

        return redirect()->route('empresas.index')
        ->with('sucesso', 'Empresa cadastrada com sucesso!');

    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empresa = Empresa::findOrFail($id);
        return view('empresas.show',compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $empresa = Empresa::findOrFail($id);
        return view('empresas.edit',compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmpresaUpdateRequest $request, $id)
    {
        $empresa = Empresa::findOrFail($id);

        $empresa->cnpj = $request->cnpj;
        $empresa->razao_social = $request->razao_social;
        $empresa->nome_fantasia = $request->nome_fantasia;
        $empresa->email = $request->email;
        $empresa->status = $request->status;
        
        if ($request->hasFile('logomarca') && $request->file('logomarca')->isValid()) {
         
            $name = uniqid(date('HisYmd'));
            $extension = $request->logomarca->extension();
            $nameFile = "{$name}.{$extension}";

            $upload = $request->logomarca->storeAs('empresas', $nameFile);

            if ( !$upload )
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer upload')
                            ->withInput();
            
            $empresa->logomarca = $upload;
        }

        
        $empresa->update();

        return redirect()->route('empresas.index')
        ->with('sucesso', 'Empresa atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empresa = Empresa::findOrFail($id);
        if($empresa->unidades->count()>0){
            return redirect()->route('empresas.index')
            ->with('aviso', 'Empresa possui unidades vinculadas!');
        }else{
            $empresa->delete();
            return redirect()->route('empresas.index')
            ->with('sucesso', 'Empresa excluída com sucesso!');
        }
    }
}
