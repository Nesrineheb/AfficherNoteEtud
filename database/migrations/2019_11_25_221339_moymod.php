<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Moymod extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('full_text_searches', function (Blueprint $table) {
           
          $table->String('CodeMod');
          $table->String('AScol');
          $table->String('MatrEtud');
          $table->Integer('NCC');
          $table->Integer('NCI');
          $table->Integer('NCF');
          $table->Integer('NTP');
          $table->Integer('Moy');
         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('full_text_searches');
    }
}
