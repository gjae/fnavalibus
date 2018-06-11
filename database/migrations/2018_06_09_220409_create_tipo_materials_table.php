<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_materials', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('codigo', 12)->default('N/A')->index('CDO');
            $table->string('nombre_tipo')->default('N/A');
            $table->softDeletes();
            $table->text('descripcion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_materials');
    }
}
