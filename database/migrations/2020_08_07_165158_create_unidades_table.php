<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->string('logomarca');
            $table->string('nome');
            $table->string('email');
            $table->unsignedBigInteger('empresa_id');             
            $table->unsignedBigInteger('cidade_id');                        
            $table->unsignedBigInteger('estado_id');            
            $table->integer('tipo');
            $table->integer('status');
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas'); 
            $table->foreign('cidade_id')->references('id')->on('cidades');
            $table->foreign('estado_id')->references('id')->on('estados');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unidades');
    }
}
