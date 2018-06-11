<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientoInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimiento_inventarios', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();

            $table->integer('inventario_id')->unsigned();
            $table->date('fecha_movimiento')->nullable();
            $table->integer('cantidad')->default(0);
            $table->string('observacion')->nullable();
            $table->enum('tipo_movimiento', [
                'INGRESO',
                'EGRESO'
            ])->default('INGRESO');

            $table->decimal('costo_movimiento', 12,2)->default(0.00);
            $table->foreign('inventario_id')->references('id')->on('inventarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimiento_inventarios');
    }
}
