<?php

namespace App;

use App\Models\Post;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Relationship mapping
     *
     */
    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function getValidationRules()
    {
        return [
            'name' => 'required|max:200',
            'email' => 'required|min:10',
            'password' => 'required',
            'role' => 'required',
        ];
    }

}
