<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawMaterialUsageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_material_usage', function (Blueprint $table) {
            $table->id();
            $table->enum('direction', ['IN', 'OUT']);
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('raw_material_id');
            $table->double('quantity');
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
        Schema::dropIfExists('raw_material_usage');
    }
}
