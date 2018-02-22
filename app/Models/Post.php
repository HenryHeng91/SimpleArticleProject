<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'body', 'cover_img'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getValidationRules()
    {
        return [
            'title' => 'required|max:200',
            'body' => 'required|min:10',
        ];
    }
}
