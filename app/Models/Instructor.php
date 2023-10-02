<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $primaryKey = 'instructor_id';
    protected $table = 'instructor';

    protected $fillable = [
        'instructor_username',
        'instructor_password',
        'instructor_security_code',
        'instructor_fname',
        'instructor_lname',
        'instructor_bday',
        'instructor_gender',
        'instructor_contactno',
        'instructor_email',
        'status',
        'instructor_credentials'
    ];
}
