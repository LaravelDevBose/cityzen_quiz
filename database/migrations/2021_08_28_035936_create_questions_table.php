<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id('question_id');
            $table->string('question_title');
            $table->text('hindi_audio');
            $table->text('english_audio');
            $table->text('gujrati_audio');
            $table->boolean('right_ans')->comment('yes=1, no=0');
            $table->text('right_ans_img');
            $table->text('wrong_ans_img');
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('questions');
    }
}
