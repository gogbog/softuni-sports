<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class CreateLeaguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leagues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->softDeletes();
            $table->string('title');
            $table->string('slug')->unique();
            NestedSet::columns($table);
            $table->boolean('visible')->default(true);
            $table->unsignedBigInteger('api_id')->nullable()->unique();
            $table->unsignedBigInteger('sport_api_id')->nullable();
            $table->timestamps();

            $table->foreign('sport_api_id')->references('api_id')->on('sports')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leagues');
    }
}
