<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDebtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Debt', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('purchase_id')->default(0);
            $table->unsignedInteger('supplier_id')->default(0);
            $table->string('invoice_id', 255)->nullable();
            $table->string('created_by', 255)->nullable();
            $table->decimal('amount', 16, 4)->default(0);
            $table->decimal('amount_left', 16, 4)->default(0);
            $table->boolean('is_complete')->default(0);
            $table->timestamp('due_date')->nullable();
            $table->timestamps();

            $table->index(['created_at', 'due_date']);
            $table->index(['purchase_id', 'supplier_id']);
            $table->engine = 'InnoDB';
        });

        Schema::create('Debt_Invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('supplier_id')->default(0);
            $table->string('created_by', 255)->nullable();
            $table->text('debt_infos')->nullable();
            $table->text('other_title')->nullable();
            $table->text('other_notes')->nullable();
            $table->decimal('amount', 16, 4)->default(0);
            $table->decimal('amount_left', 16, 4)->default(0);
            $table->boolean('is_supplier')->default(1);
            $table->timestamp('paid_date')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->index('created_at');
            $table->index('supplier_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Debt_Invoice');
        Schema::dropIfExists('Debt');
    }
}
