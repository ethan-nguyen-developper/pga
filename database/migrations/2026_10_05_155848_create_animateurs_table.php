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
        Schema::create('animateurs', function (Blueprint $table) {
            $table->id();
            $table->string("nom");
            $table->string("prenom");
            $table->char("sexe");
            $table->integer("age");
            $table->foreignId("localisation_id")->constrained();
            $table->string("photo")->nullable();
            $table->timestamps("");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(function(Blueprint $table) {
            $table->dropConstrainedForeignId("localisation_id");
        });
        Schema::dropIfExists('animateurs');
    }
};
