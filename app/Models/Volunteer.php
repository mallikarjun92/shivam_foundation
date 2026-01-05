<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Volunteer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'slug',
        'occupation',
        'testimonial',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'zip_code',
        'skills',
        'interests',
        'introduction',
        'availability',
        'previous_experience',
        'photo',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($volunteer) {
            if (empty($volunteer->slug)) {
                $volunteer->slug = self::generateUniqueSlug($volunteer->first_name . ' ' . $volunteer->last_name);
            }
        });

        static::updating(function ($volunteer) {
            if (
                empty($volunteer->slug) ||
                $volunteer->isDirty('first_name') ||
                $volunteer->isDirty('last_name')
                ) {
                $volunteer->slug = self::generateUniqueSlug($volunteer->first_name . ' ' . $volunteer->last_name);
            }
        });
    }

    private static function generateUniqueSlug($name, $ignoreId = null)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (
            self::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            return asset('storage/' . $this->photo);
        }
        
        return asset('images/default-volunteer.jpg');
    }

}