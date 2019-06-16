<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class CreateFixturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixtures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->softDeletes();
            $table->string('title');
            $table->string('homeTeam');
            $table->string('enemyTeam');
            $table->string('slug')->unique();
            NestedSet::columns($table);
            $table->boolean('visible')->default(true);
            $table->unsignedBigInteger('api_id')->nullable()->unique();
            $table->unsignedBigInteger('league_api_id')->nullable();
            $table->dateTime('date');
            $table->integer('homeTeamScore');
            $table->integer('awayTeamScore');
            $table->decimal('homeTeamOdds', 2,1)->nullable();
            $table->decimal('awayTeamOdds', 2,1)->nullable();
            $table->decimal('drawOdds', 2,1)->nullable();
            $table->timestamps();

            $table->foreign('league_api_id')->references('api_id')->on('leagues')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fixtures');
    }
}
