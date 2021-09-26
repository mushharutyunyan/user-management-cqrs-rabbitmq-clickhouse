<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public static function create($data)
    {
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->save();
        return $user;
    }
}
