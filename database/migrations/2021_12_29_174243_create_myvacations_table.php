<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyvacationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('myvacations', function (Blueprint $table) {
            
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->foreignId('vacation_id')->constrained()->onDelete('cascade');
            $table->date('start');
            $table->date('end');
            $table->set('pay_in_advance', ['pay_in_advance','pay_with_payroll'])->nullable();
            $table->boolean('visa')->nullable();
            $table->boolean('ticket')->nullable();
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('myvacations');
    }
}
