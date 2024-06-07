<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(){
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->float('cost');
            $table->string('chat_credit');
            $table->timestamps();
        });
    }

    public function down(){

        Schema::dropIfExists('packages');
    }
};
