<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreatedAtIndexToMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            //
            // $table->index(['created_at', 'update_at']);
            $table->index('created_at');

            /*
            En este caso estamos pasando como segundo parametro el nombre del index, en cuyo caso tendriamos que usar el mismo nombre el la parte de down()
            $table->index('created_at', 'my_created_at_idx');
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            // Si no hay nombre definido en el segundo parametro en up(), por convención se usa el siguiente formato
            // El nombre del indice se contruye con el nombre de la tabla, seguido de la/s columna involucrada y por ultimo la palabra index
            $table->dropIndex('messages_created_at_index');
        });
    }
}
