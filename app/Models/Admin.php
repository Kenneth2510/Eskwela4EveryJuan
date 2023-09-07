<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{

    protected $connection = 'mysql';
    protected $primaryKey = 'admin_id';
    protected $table = 'admin';

    use HasFactory;

    protected $fillable = [
        'admin_username',
        'admin_codename',
        'admin_password'
    ];
}
