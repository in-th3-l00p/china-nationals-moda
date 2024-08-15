<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    use HasFactory;

    protected $fillable = [
        "trucker_id"
    ];

    public function trucker() {
        return $this->belongsTo(User::class, "trucker_id");
    }

    public function packages() {
        return $this->hasMany(Package::class);
    }

    public function fromCampus() {
        return $this->belongsTo(Campus::class, "from_campus_id");
    }

    public function toCampus() {
        return $this->belongsTo(Campus::class, "to_campus_id");
    }
}
