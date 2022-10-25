<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('system_id')
                ->unique()
                ->nullable()
                ->default(NULL);
            $table->string('title');
            $table->boolean('does_expire')
                ->default(false);
            $table->boolean('has_count')
                ->default(false);
            $table->unsignedTinyInteger('count');
            $table->timestamps();
            $table->timestamp('expiry_date')
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
        Schema::dropIfExists('subscriptions');
    }
}
