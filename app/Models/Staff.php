<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';

    protected $fillable = ['name', 'email', 'phone', 'image'];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_staff');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
