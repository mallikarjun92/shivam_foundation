<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Team extends Model
{
    use HasFactory;

    // Table name (optional, Laravel will auto-detect)
    protected $table = 'teams';

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'name',
        'title',
        'description',
        'image',
        'contact_email',
        'contact_phone',
        'slug',
    ];

    /**
     * Casts (optional but good practice)
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($team) {
            $team->slug = self::generateUniqueSlug($team->name);
        });

        static::updating(function ($team) {
            if ($team->isDirty('name')) {
                $team->slug = self::generateUniqueSlug(
                    $team->name,
                    $team->id
                );
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
}
