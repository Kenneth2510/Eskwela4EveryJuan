<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearnerCourse extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $primaryKey = 'learner_course_id';
    protected $table = 'learner_course';

    protected $fillable = [
      'learner_id',
      'course_id',
    ];

    public function learner()
    {
        return $this->belongsToMany(Learner::class, 'learner_id');
    }

    public function course()
    {
        return $this->belongsToMany(Course::class, 'course_id');
    }
}
