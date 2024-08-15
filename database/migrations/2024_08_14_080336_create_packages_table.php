<?php

use App\Models\Campus;
use App\Models\Container;
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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table
                ->string("tracking_number")
                ->unique();
            $table->timestamps();
            $table
                ->foreignIdFor(User::class)
                ->constrained("users");
            $table->string("recipient_name");
            $table->string("recipient_phone_number");

            $table
                ->foreignIdFor(Campus::class, "from_campus_id")
                ->constrained("campuses");
            $table->string("from_address");
            $table
                ->foreignIdFor(Campus::class, "to_campus_id")
                ->constrained("campuses");
            $table->string("to_address");

            $table
                ->foreignIdFor(User::class, "pickup_courier_id")
                ->constrained("users");
            $table
                ->foreignIdFor(User::class, "delivery_courier_id")
                ->nullable()
                ->constrained("users");

            $table
                ->foreignIdFor(Container::class)
                ->nullable()
                ->constrained("containers");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
