<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizUser extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'quiz_users';
    protected $primaryKey='id';

    protected $fillable = [
        'first_name',
        'last_name',
        'phone_no',
        'email',
        'pin_code',
        'city',
        'status',
        'result'
    ];

}
