<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'surname',
        'first_name',
        'middle_name',
        'suffix',
        'year_standing',
        'college',
        'degree_program',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}