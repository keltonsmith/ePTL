<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIqBillNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iq_bill_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inspection_id')->unsigned();
            $table->tinyInteger('q0');
            $table->string('q0_note');
            $table->tinyInteger('q1');
            $table->string('q1_note');
            $table->tinyInteger('q2');
            $table->string('q2_note');
            $table->tinyInteger('q3');
            $table->string('q3_note');
            $table->tinyInteger('q4');
            $table->string('q4_note');
            $table->tinyInteger('q5');
            $table->string('q5_note');
            $table->tinyInteger('q6');
            $table->string('q6_note');
            $table->tinyInteger('q7');
            $table->string('q7_note');
            $table->tinyInteger('q8');
            $table->string('q8_note');
            $table->tinyInteger('q9');
            $table->string('q9_note');
            $table->tinyInteger('q10');
            $table->string('q10_note');
            $table->tinyInteger('q11');
            $table->string('q11_note');
            $table->tinyInteger('q12');
            $table->string('q12_note');
            $table->tinyInteger('q13');
            $table->string('q13_note');
            $table->tinyInteger('q14');
            $table->string('q14_note');
            $table->tinyInteger('q15');
            $table->string('q15_note');
            $table->tinyInteger('q16');
            $table->string('q16_note');
            $table->tinyInteger('q17');
            $table->string('q17_note');
            $table->tinyInteger('q18');
            $table->string('q18_note');
            $table->tinyInteger('q19');
            $table->string('q19_note');
            $table->tinyInteger('q20');
            $table->string('q20_note');
            $table->tinyInteger('q21');
            $table->string('q21_note');
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
        Schema::drop('iq_bill_notes');
    }
}
