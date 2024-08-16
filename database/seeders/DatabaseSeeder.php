<?php

namespace Database\Seeders;

use App\Models\Campus;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach (["A", "B", "C", "D", "E"] as $letter) {
            Campus::create([
                "letter" => $letter
            ]);
        }

        User::factory()->create([
            "username" => "admin",
            "password" => Hash::make("admin"),
            "type" => "admin"
        ]);

        User::factory()->create([
            "email" => "client@wsc.com",
            "password" => Hash::make("client"),
            "first_name" => "John",
            "last_name" => "Doe",
            "phone" => "11890481",
            "type" => "user"
        ]);
        User::factory()->create([
            "email" => "smith@wsc.com",
            "password" => Hash::make("smith"),
            "first_name" => "Mary",
            "last_name" => "Smith",
            "phone" => "33178732",
            "type" => "user"
        ]);

        User::factory()->create([
            "email" => "courier@wsc.com",
            "password" => Hash::make("courier"),
            "first_name" => "Matthew",
            "last_name" => "Green",
            "phone" => "11890481",
            "campus_id" => Campus::query()
                ->where("letter", "=", "A")
                ->first()
                ->id,
            "type" => "courier"
        ]);
        User::factory()->create([
            "email" => "a_courier@wsc.com",
            "password" => Hash::make("courier_a"),
            "first_name" => "David",
            "last_name" => "Hill",
            "phone" => "33178732",
            "campus_id" => Campus::query()
                ->where("letter", "=", "A")
                ->first()
                ->id,
            "type" => "courier"
        ]);
        User::factory()->create([
            "email" => "b_courier@wsc.com",
            "password" => Hash::make("courier_b"),
            "first_name" => "Sarah",
            "last_name" => "Allen",
            "phone" => "89471648",
            "campus_id" => Campus::query()
                ->where("letter", "=", "B")
                ->first()
                ->id,
            "type" => "courier"
        ]);
        User::factory()->create([
            "email" => "c_courier@wsc.com",
            "password" => Hash::make("courier_c"),
            "first_name" => "James",
            "last_name" => "Lewis",
            "phone" => "38475913",
            "campus_id" => Campus::query()
                ->where("letter", "=", "C")
                ->first()
                ->id,
            "type" => "courier"
        ]);
        User::factory()->create([
            "email" => "d_courier@wsc.com",
            "password" => Hash::make("courier_d"),
            "first_name" => "Daniel",
            "last_name" => "King",
            "phone" => "67846378",
            "campus_id" => Campus::query()
                ->where("letter", "=", "D")
                ->first()
                ->id,
            "type" => "courier"
        ]);
        User::factory()->create([
            "email" => "e_courier@wsc.com",
            "password" => Hash::make("courier_e"),
            "first_name" => "Joseph",
            "last_name" => "Phi",
            "phone" => "17264527",
            "campus_id" => Campus::query()
                ->where("letter", "=", "E")
                ->first()
                ->id,
            "type" => "courier"
        ]);

        $trucker = User::factory()->create([
            "email" => "trucker@wsc.com",
            "password" => Hash::make("trucker"),
            "first_name" => "Harper",
            "last_name" => "Lopez",
            "plate" => "A10001",
            "route" => 1,
            "type" => "trucker"
        ]);
        $trucker->campus()->associate(Campus::query()
            ->where("letter", "=", "A")
            ->first())
            ->save();
        $trucker = User::factory()->create([
            "email" => "trucker1@wsc.com",
            "password" => Hash::make("trucker1"),
            "first_name" => "Samuel",
            "last_name" => "Nelson",
            "plate" => "B10001",
            "route" => 1,
            "type" => "trucker"
        ]);
        $trucker->campus()->associate(Campus::query()
            ->where("letter", "=", "A")
            ->first())
            ->save();
        $trucker = User::factory()->create([
            "email" => "trucker2_1@wsc.com",
            "password" => Hash::make("trucker2"),
            "first_name" => "Grace",
            "last_name" => "Adams",
            "plate" => "C10001",
            "route" => 2,
            "type" => "trucker"
        ]);
        $trucker->campus()->associate(Campus::query()
            ->where("letter", "=", "E")
            ->first())
            ->save();
        $trucker = User::factory()->create([
            "email" => "trucker2_2@wsc.com",
            "password" => Hash::make("trucker3"),
            "first_name" => "Mia",
            "last_name" => "Mitchell",
            "plate" => "D10001",
            "route" => 2,
            "type" => "trucker"
        ]);
        $trucker->campus()->associate(Campus::query()
            ->where("letter", "=", "D")
            ->first())
            ->save();
    }
}
