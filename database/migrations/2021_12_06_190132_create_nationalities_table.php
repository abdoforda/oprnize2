<?php

use App\Nationality;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNationalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nationalities', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_ar');

            $table->foreignId('company_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
            
        });

        $data = [
            ['name_ar'=>'السعودية','name_en'=>'Saudi Arabia'],
            ['name_ar'=>'مصر','name_en'=>'Egypt'],
            ['name_ar'=>'باكستان','name_en'=>'Pakistan'],
            ['name_ar'=>'اليمن','name_en'=>'Yemen'],
            ['name_ar'=>'سوريا','name_en'=>'Syria'],
            ['name_ar'=>'الهند','name_en'=>'India'],
            ['name_ar'=>'بنغلاديش','name_en'=>'Bangladesh'],
            ['name_ar'=>'الأردن','name_en'=>'Jordan'], 
            ['name_ar'=>'فلسطين','name_en'=>'Palestine'],
            ['name_ar'=>'لبنان','name_en'=>'Lebanon'],
            ['name_ar'=>'السودان','name_en'=>'Sudan'],
            ['name_ar'=>'الفلبين','name_en'=>'Philippines'],
            ['name_ar'=>'اندونيسيا','name_en'=>'Indonesia'],
            ['name_ar'=>'اريتريا','name_en'=>'Eritrea'],
            ['name_ar'=>'النيبال','name_en'=>'Nepal'],
            ['name_ar'=>'بريطانيا','name_en'=>'Britain'],
            ['name_ar'=>'امريكا','name_en'=>'America'],
            ['name_ar'=>'فرنسا','name_en'=>'France'],
        ];

        Nationality::insert($data);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nationalities');
    }
}
