<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('project_id');
            $table->string('sub_domain');
            $table->timestamps();

            $table->unique(['project_id','sub_domain']);
        });

        Schema::create('urls', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('site_id');
            $table->text('url');
            $table->integer('status_code')->nullable();
            $table->text('html')->nullable();
            $table->timestamps();

            $table->unique(['site_id','url']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
        Schema::dropIfExists('sites');
        Schema::dropIfExists('urls');
    }
};
