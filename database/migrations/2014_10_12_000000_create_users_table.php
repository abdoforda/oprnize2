<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('domain');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->set('type',['admin','employee'])->default('admin');
            $table->integer('employee_id')->nullable()->constrained()->onDelete('cascade'); // end
            $table->integer('company_id')->nullable()->constrained()->onDelete('cascade'); // end
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
