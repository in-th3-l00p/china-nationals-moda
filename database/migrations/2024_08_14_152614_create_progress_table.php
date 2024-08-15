<?php

use App\Models\Campus;
use App\Models\Package;
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
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->enum("status", [
                "Pending pickup",
                "Picked up",
                "Pending transit",
                "In transit",
                "Pending delivery",
                "Delivering",
                "Signed"
            ]);
            $table
                ->boolean("returning")
                ->default(false);
            $table->foreignIdFor(Campus::class)
                ->nullable()
                ->constrained("campuses");
            $table
                ->foreignIdFor(Package::class)
                ->constrained("packages");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
