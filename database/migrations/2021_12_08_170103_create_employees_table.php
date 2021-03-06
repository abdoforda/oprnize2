<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {

            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade'); // end
            $table->string('name_ar'); // end
            $table->string('name_en'); // end
            $table->foreignId('nationality_id')->nullable()->constrained()->onDelete('cascade'); // end
            $table->foreignId('department_id')->nullable()->constrained()->onDelete('cascade'); // end
            $table->foreignId('section_id')->nullable()->constrained()->onDelete('cascade'); // end
            $table->foreignId('job_id')->nullable()->constrained()->onDelete('cascade'); // end
            $table->foreignId('workshift_id')->nullable()->constrained()->onDelete('cascade'); // end
            $table->string('photo')->nullable();
            $table->string('job_number'); // end
            $table->date('birthdate')->nullable();
            $table->set('marital_status',['married','single'])->nullable(); // end
            $table->set('gender',['male','female'])->nullable(); // end
            $table->integer('test_period')->nullable();
            $table->string('id_num')->nullable(); // end
            $table->date('id_issue_date')->nullable(); // end
            $table->date('id_expire_date')->nullable(); // end
            $table->string('passport_num')->nullable(); // end
            $table->date('passport_issue_date')->nullable(); // end
            $table->date('passport_expire_date')->nullable(); // end
            $table->string('issue_place')->nullable();
            $table->set('employment_type',['full_time','part_time','seasonal','temporary'])->nullable(); // end
            $table->set('contract_type',['limited','unlimited'])->nullable(); // end
            $table->date('contract_start_date'); // end
            $table->date('contract_end_date')->nullable(); // end
            $table->integer('contract_period')->nullable();
            $table->string('phone')->nullable(); // end
            $table->integer('annual_balance')->default(21);
            $table->decimal('available_balance')->nullable();
            $table->string('email')->nullable(); // end
            $table->decimal('salary')->default(0);
            $table->decimal('hra_value')->nullable();
            $table->decimal('hra_percentage')->nullable();
            $table->decimal('trans_value')->nullable();
            $table->decimal('trans_percentage')->nullable();
            $table->string('password')->nullable(); // end
            $table->timestamps();
            $table->softDeletes();
            $table->string('id_issue_date_hijri')->nullable(); // end
            $table->string('id_expire_date_hijri')->nullable(); // end
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
