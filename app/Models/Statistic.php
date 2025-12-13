<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $fillable = [
        'children_served',
        'volunteers',
        'meals_distributed',
        'countries_active',
        'country_list',
    ];

    protected $casts = [
        'country_list' => 'array',
    ];
}
