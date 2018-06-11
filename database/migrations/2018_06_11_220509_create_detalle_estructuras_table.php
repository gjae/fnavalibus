<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleEstructurasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_estructuras', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('observacion')->nullable();
            $table->integer('inventario_id')->unsigned();
            $table->integer('plantacion_id')->unsigned();
            $table->integer('unidad_medida_id')->unsigned();


            $table->foreign('unidad_medida_id')->references('id')->on('unidad_medidas');
            $table->foreign('inventario_id')->references('id')->on('inventarios');
            $table->foreign('plantacion_id')->references('id')->on('plantacions');

            /**
             * COSTO APROXIMADO PARA LA FECHA DE SU USO
             * (NO ES NECESARIAMENTE IGUAL AL COSTO ORIGINAL AL MOMENTO DE SU
             * ADQUISICION)
             */
            $table->decimal('costo_material', 10,2)->default(0.00);
            $table->decimal('cantidad_usada', 10,2)->default(0.00);
            $table->decimal('monto_total', 10,2)->default(0.00);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_estructuras');
    }
}
