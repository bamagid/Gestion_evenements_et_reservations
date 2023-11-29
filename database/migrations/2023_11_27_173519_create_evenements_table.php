<?php

use App\Models\Association;
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
        Schema::create('evenements', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->dateTime('date_limite_inscription')->nullable()->default(now());
            $table->string('description');
            $table->string('image_mise_en_avant');
            $table->boolean('est_cloture_ou_pas')->default(false);
            $table->string('lieux');
            $table->foreignIdFor(Association::class)->constrained()->onDelete('cascade');
            $table->dateTime('date_evenement')->default(now());

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evenements');
    }
};
