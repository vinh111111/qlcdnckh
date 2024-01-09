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
        Schema::create('projectapprovals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',255);
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_type');
            $table->foreign('id_type')->references('id')->on('typeprojects')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('summary');
            $table->string('image',255);
            $table->string('reports',255);
            $table->string('application_link',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projectapprovals');
    }
};
