<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Contracts\Role;


class Member extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    protected $guard = 'member';

    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function username()
    {
        return 'username';
    }
}