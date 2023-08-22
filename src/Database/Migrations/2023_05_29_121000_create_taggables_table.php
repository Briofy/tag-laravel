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
        Schema::connection(config('briofy-tag.database.connection'))
            ->create('taggables', function (Blueprint $table) {
                config('briofy-tag.database.uuid') ? $table->foreignUuid('tag_id')->constrained('tags')->cascadeOnUpdate()->cascadeOnDelete()
                    : $table->foreignId('tag_id')->constrained('tags')->cascadeOnUpdate()->cascadeOnDelete();
                config('briofy-tag.database.taggable_uuid') ? $table->uuidMorphs('taggable')
                    : $table->morphs('taggable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taggables');
    }
};
