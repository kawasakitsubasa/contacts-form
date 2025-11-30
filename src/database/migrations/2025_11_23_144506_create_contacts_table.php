<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
             $table->id();
             $table->string('last_name');
             $table->string('first_name');
             $table->tinyInteger('gender'); // 1:男性 2:女性 3:その他
             $table->string('email');
             $table->string('tel1', 5);
             $table->string('tel2', 5);
             $table->string('tel3', 5);
             $table->string('address');
             $table->string('building')->nullable();
             $table->unsignedBigInteger('category_id');
             $table->string('detail', 120);
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
        Schema::dropIfExists('contacts');
    }
}
