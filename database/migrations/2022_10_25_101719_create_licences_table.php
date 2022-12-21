<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licences', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('system_id')
                ->unique()
                ->nullable()
                ->default(NULL);
            $table->boolean('does_expire')
                ->default(false);
            $table->boolean('has_count')
                ->default(false);
            $table->unsignedTinyInteger('count');
            $table->timestamps();
            $table->timestamp('expire_at')
                ->nullable()
                ->default(NULL); 
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('licences');
    }
}
