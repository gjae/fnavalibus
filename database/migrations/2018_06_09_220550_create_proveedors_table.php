<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedors', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('razon_social', 120);
            $table->string('rif', 22)->index();
            $table->enum('personalidad', ['J', 'N'])->default('J');

            $table->string('correo', 120)->nullable();
            $table->string('telefono_contacto', 18)->nullable();
            $table->text('direccion')->nullable();

            /**
             * REPRESENTANTE
             */
            $table->string('nombre_representante', 50)->nullable();
            $table->string('apellido_representante', 50)->nullable();
            $table->string('identificacion_representante', 15)->nullable();
            $table->string('correo_representante', 110)->nullable();
            $table->string('telefono_movil_representante', 12)->nullable();
            $table->string('telefono_habitacion_representante', 12)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedors');
    }
}
