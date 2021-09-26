<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Response\ClientResponse;
use App\Models\User;
use Illuminate\Support\Facades\Redis;

class QueryController extends Controller
{

    public function getAll()
    {
        $cachedUsers = Redis::get('users');
        if(!isset($cachedUsers)) {
            $users = json_decode($cachedUsers, true);
        }else {
            $users = User::getLimitedData()->get();
            Redis::set('users', $users);
            $users = $users->toArray();
        }
        return ClientResponse::success('Fetched from database', $users);
    }
}
