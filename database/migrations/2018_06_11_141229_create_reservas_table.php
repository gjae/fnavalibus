<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->text('descripcion')->nullable();
            $table->integer('tipo_material_id')->unsigned();
            $table->decimal('total_gasto', 10,2)->default(0.00);
            $table->decimal('costo_rubro_mercado', 10,2)->default(0.00);
            $table->integer('unidad_medida_id')->unsigned();
            $table->integer('tiempos_duracion_id')->unsigned();

            /**
             * PARA HACERLO LO MAS GENERICO POSIBLE UTILIZAMOS UNA FECHA
             * DE INICIO Y UNA FECHA DE FINALIZACION , EN EL TIPO DE RUBRO SE PUEDE
             * ESPECIFICAR SI ES "CRIA, VEGETAL, FRUTAL, FLORAL, OTROS"
             */
            $table->enum('tipo_rubro', [
                'CRIA',
                'VEGETAL',
                'FRUTAL',
                'FLORAL',
                'OTROS'
            ])->default('VEGETAL');

            $table->enum('finalidad', [
                'CONSUMO_INTERNO',
                'VENTA',
                'DONACION',
                'CONSUMO_COMUNIDAD'
            ])->default('CONSUMO_INTERNO');



            $table->foreign('unidad_medida_id')->references('id')->on('unidad_medidas');
            $table->foreign('tiempos_duracion_id')->references('id')->on('tiempos_duracions');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservas');
    }
}
