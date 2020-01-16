<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->text('first_name');
            $table->text('surname');
            $table->text('id_number')->unique();
            $table->text('ec_number')->unique();
            $table->date('dob');
            $table->bigInteger('department')->nullable();
            $table->text('cell_number')->nullable();
            $table->bigInteger('employment_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
