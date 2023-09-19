<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Learner extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $primaryKey = 'learner_id';
    protected $table = 'learner';

    protected $fillable = [
        'learner_username',
        'learner_password',
        'learner_security_code',
        'learner_fname',
        'learner_lname',
        'learner_bday',
        'learner_gender',
        'learner_contactno',
        'learner_email'
    ];
}
