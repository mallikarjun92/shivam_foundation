<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FeaturedDonor extends Model
{
    //
    protected $fillable = [
        'name',
        'slug',
        'image',
        'amount',
        'donated_at',
        'published',
        'user_id'
    ];

    protected $casts = [
        'donated_at' => 'datetime',
        'published' => 'boolean',
        'amount' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($donor) {
            if (!$donor->slug) {
                $donor->slug = Str::slug($donor->name . '-' . uniqid());
            }
        });

        static::updating(function ($donor) {
            if (!$donor->slug) {
                $donor->slug = Str::slug($donor->name . '-' . uniqid());
            }
        });
    }

    // Format donated date
    public function getFormattedDonatedAtAttribute()
    {
        return $this->donated_at ? $this->donated_at->format('M d, Y') : null;
    }
}
