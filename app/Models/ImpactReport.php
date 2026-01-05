<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImpactReport extends Model
{
    protected $fillable = [
        'title',
        'description',
        'file_path',
    ];

    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }
}