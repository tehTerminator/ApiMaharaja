<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_ledger_id');
            $table->boolean('paid');
            $table->unsignedBigInteger('payment_ledger_id')->nullable()->default(NULL);
            $table->foreign('supplier_ledger_id')->references('id')->on('ledger');
            $table->foreign('payment_ledger_id')->references('id')->on('ledger');
            $table->double('amount')->default(0);
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
        Schema::dropIfExists('purchase_invoices');
    }
}
