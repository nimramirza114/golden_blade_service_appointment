<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['category_id', 'name', 'description', 'price', 'duration_minutes', 'image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function staff()
    {
        return $this->belongsToMany(Staff::class, 'service_staff');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}