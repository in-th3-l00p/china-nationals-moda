<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'type',
        'first_name',
        'last_name',
        'phone',
        'plate',
        'campus_id',
        'online'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function campus() {
        return $this->belongsTo(Campus::class);
    }

    public function sentPackages() {
        return $this->hasMany(Package::class);
    }

    public function pickupPackages() {
        return $this->hasMany(Package::class, "pickup_courier_id");
    }

    public function deliveryPackages() {
        return $this->hasMany(Package::class, "delivery_courier_id");
    }

    public function containers() {
        return $this->hasMany(Container::class, "trucker_id");
    }

    public function scopeUser($query) {
        $query->where("type", "=", "user");
    }

    public function scopeStaff($query) {
        $query
            ->where("type", "=", "courier")
            ->orWhere("type", "=", "trucker");
    }

    public function scopeCourier($query, $campus_id) {
        $query
            ->withCount("pickupPackages")
            ->where("pickup_packages_count", "<", 5)
            ->where("type", "=", "courier")
            ->where("campus_id", "=", $campus_id);
    }
}
