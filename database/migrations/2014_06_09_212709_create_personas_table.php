<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('cedula', 12)->index('cedula');
            $table->string('telefono_movil')->nullable();
            $table->string('telefono_habitacion', 12)->nullable();
            $table->date('fecha_nacimiento')->nullable();

            $table->text('direccion')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
