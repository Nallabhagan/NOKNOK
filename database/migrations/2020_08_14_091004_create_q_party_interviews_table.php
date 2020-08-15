<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQPartyInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q_party_interviews', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('qparty_id')->references('id')->on('q_parties');
            $table->text('question');
            $table->text('answer')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('q_party_interviews');
    }
}
