<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->string('id', 100)->nullable(false)->primary();
            $table->string('name', 100)->nullable(false);
        });

        Schema::create('taggables', function (Blueprint $table) {
            $table->string('tag_id', 100)->nullable(false);
            $table->string('taggables_id', 100)->nullable(false);
            $table->string('taggables_type', 100)->nullable(false);
            $table->primary(['tag_id', 'taggables_id', 'taggables_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('taggables');
    }
};
