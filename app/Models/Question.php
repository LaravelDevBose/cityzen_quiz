<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';
    protected $primaryKey='question_id';

    protected $fillable = [
        'question_title',
        'hindi_audio',
        'english_audio',
        'gujrati_audio',
        'right_ans',
        'right_ans_img',
        'wrong_ans_img',
        'status'
    ];

    protected $appends=['hin_aud_path', 'eng_aud_path', 'guj_aud_path', 'right_img_path', 'wrong_img_path'];

    public function getHinAudPathAttribute()
    {
        return asset('storage/'.$this->attributes['hindi_audio']);
    }

    public function getEngAudPathAttribute()
    {
        return asset('storage/'.$this->attributes['english_audio']);
    }

    public function getGujAudPathAttribute()
    {
        return asset('storage/'.$this->attributes['gujrati_audio']);
    }
    public function getRightImgPathAttribute()
    {
        return asset('storage/'.$this->attributes['right_ans_img']);
    }
    public function getWrongImgPathAttribute()
    {
        return asset('storage/'.$this->attributes['wrong_ans_img']);
    }

}
