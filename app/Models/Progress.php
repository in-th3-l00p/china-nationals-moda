<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $fillable = [
        "status",
        "returning",
        "package_id"
    ];

    public function package() {
        return $this->belongsTo(Package::class);
    }

    public function campus() {
        return $this->belongsTo(Campus::class);
    }
}
