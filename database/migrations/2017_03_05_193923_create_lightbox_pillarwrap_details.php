<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLightboxPillarwrapDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lightbox_pillarwrap_details', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->integer('application_id')->unsigned();
            $table->string('column_code');
            $table->string('from');
            $table->string('up');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('application_id')
                ->references('id')->on('applications')
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
        Schema::drop('lightbox_pillarwrap_details');
    }
}
