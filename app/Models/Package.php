<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        "tracking_number",
        "user_id",
        "from_campus_id",
        "from_address",
        "recipient_name",
        "recipient_phone_number",
        "to_campus_id",
        "to_address",
        "pickup_courier_id",
        "delivery_courier_id",
        "container_id",
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function fromCampus() {
        return $this->belongsTo(
            Campus::class,
            "from_campus_id"
        );
    }

    public function toCampus() {
        return $this->belongsTo(
            Campus::class,
            "to_campus_id"
        );
    }

    public function pickupCourier() {
        return $this->belongsTo(
            User::class,
            "pickup_courier_id"
        );
    }

    public function deliveryCourier() {
        return $this->belongsTo(
            User::class,
            "delivery_courier_id"
        );
    }

    public function progress() {
        return $this->hasMany(Progress::class);
    }

    public function status() {
        return $this
            ->progress()
            ->one()
            ->latestOfMany();
    }
}
