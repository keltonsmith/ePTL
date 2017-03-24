<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIqNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iq_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inspection_id')->unsigned();
            $table->boolean('q0_0');
            $table->string('q0_1_note');
            $table->boolean('q1_0');
            $table->string('q1_1_note');
            $table->boolean('q2_0');
            $table->string('q2_1_note');
            $table->boolean('q3_0');
            $table->string('q3_1_note');
            $table->boolean('q4_0');
            $table->boolean('q4_1');
            $table->boolean('q4_2');
            $table->string('q4_1_note');
            $table->string('q4_2_note');
            $table->string('q4_3_note');
            $table->boolean('q5_0');
            $table->boolean('q5_1');
            $table->boolean('q5_2');
            $table->boolean('q5_3');
            $table->boolean('q5_4');
            $table->boolean('q5_5');
            $table->string('q5_1_note');
            $table->string('q5_2_note');
            $table->string('q5_3_note');
            $table->string('q5_4_note');
            $table->string('q5_5_note');
            $table->string('q5_6_note');
            $table->boolean('q6_0');
            $table->string('q6_1_note');
            $table->boolean('q7_0');
            $table->string('q7_1_note');
            $table->boolean('q8_0');
            $table->boolean('q8_1');
            $table->boolean('q8_2');
            $table->boolean('q8_3');
            $table->boolean('q8_4');
            $table->boolean('q8_5');
            $table->string('q8_1_note');
            $table->string('q8_2_note');
            $table->string('q8_3_note');
            $table->string('q8_4_note');
            $table->string('q8_5_note');
            $table->string('q8_6_note');
            $table->boolean('q9_0');
            $table->boolean('q9_1');
            $table->string('q9_1_note');
            $table->string('q9_2_note');
            $table->boolean('q10_0');
            $table->string('q10_1_note');
            $table->timestamps();

            $table->foreign('inspection_id')
                ->references('id')->on('inspections')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('iq_notes');
    }
}
