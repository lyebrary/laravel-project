<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    protected $fillable = ['capacity', 'start', 'end'];

    public function attendanceLogs()
    {
        return $this->hasMany(AttendanceLog::class);
    }

    public static function getCurrent()
    {
        return self::whereNotNull('start')
            ->where('end', '>', now())
            ->first();
    }
}