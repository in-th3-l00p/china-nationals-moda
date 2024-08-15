<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    use HasFactory;

    protected $fillable = [
        "letter"
    ];

    public function users() {
        return $this->hasMany(User::class);
    }

    public function truckers() {
        return $this
            ->hasMany(User::class)
            ->where("type", "=", "trucker");
    }

    public function fr_truckers() {
        return $this
            ->truckers()
            ->where("route", "=", "1");
    }

    public function sr_truckers() {
        return $this
            ->truckers()
            ->where("route", "=", "2");
    }

    public function sentPackages() {
        return $this->hasMany(Package::class, "from_campus_id");
    }

    public function receivePackages() {
        return $this->hasMany(Package::class, "to_campus_id");
    }
}
