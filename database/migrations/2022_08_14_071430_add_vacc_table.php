<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccs', function (Blueprint $table) {
            $table->id();
            $table->boolean('isMENA')
                ->default(false);
            $table->string('code')
                ->unique()
                ->comment('A unique code for identifiying the vACC.');
            $table->string('name')
                ->comment('The full name of the vACC.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vaccs');
    }
};
