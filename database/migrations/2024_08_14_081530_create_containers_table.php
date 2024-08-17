<?php

use App\Models\Campus;
use App\Models\User;
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
        Schema::create('containers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table
                ->foreignIdFor(User::class, "trucker_id")
                ->nullable()
                ->constrained("users");

            $table
                ->foreignIdFor(Campus::class, "from_campus_id")
                ->constrained("campuses");
            $table
                ->foreignIdFor(Campus::class, "to_campus_id")
                ->constrained("campuses");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('containers');
    }
};
