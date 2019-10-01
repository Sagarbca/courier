<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('student', function (Blueprint $table) {
                   $table->bigIncrements('id');
                   $table->char('first_name',100);
                   $table->char('last_name',100)->nullable();
                   $table->date('date_of_birth');
                   $table->string('subject',25);
                   $table->string('Phone' ,15);
                   $table->string('email',25);
                   $table->string('gender',25);
                   $table->string('address', 500)->nullable();
                   $table->date('joinning_date');
                   $table->string('admission_no', 500)->nullable();
                   $table->boolean('status_id')->default(1);

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
        Schema::dropIfExists('student');
    }
}
