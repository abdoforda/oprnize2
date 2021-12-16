<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllowancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allowances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('employee_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('name_en');
            $table->string('name_ar');
            $table->set('type',['addition','deduction']);
            $table->decimal('value', 8, 2)->nullable();
            $table->decimal('percentage', 8, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('allowances');
    }
}
