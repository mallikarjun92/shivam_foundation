<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramsEnrollment extends Model
{
    //
    protected $table = 'programs_enrollments';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'dob',
        'country',
        'state',
        'payment_status',
        'payment_id',
        'payment_method',
        'payment_amount',
        'payment_currency',
        'remarks',
        'gender',
        'program_type',
        'is_new'
    ];

    protected $casts = [
        'dob' => 'date',
    ];
}
