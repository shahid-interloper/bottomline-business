<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{

    protected $fillable = ['email_sent'];

    use HasFactory, Notifiable;

    public function courses()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
