<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Response\ClientResponse;
use App\Models\User;
use Illuminate\Support\Facades\Redis;

class QueryController extends Controller
{
    protected $rowsCount = 30;

    public function getAll()
    {
        $cachedUsers = Redis::get('users');
        if(isset($cachedUsers)) {
            $users = json_decode($cachedUsers, true);
            return ClientResponse::success('Fetched from redis', $users);
        }else {
            $users = User::orderBy('created_at','DESC')->take($this->rowsCount)->get();
            Redis::set('users', $users);
            $users = $users->toArray();
            return response()->json(ClientResponse::success('Fetched from database', $users));
        }
    }
}
