<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Response\ClientResponse;
use App\Jobs\CreateLogUserJob;
use App\Models\User;
use App\Services\ClickHouseService;
use App\Services\UserService;

class CommandController extends Controller
{
    public function store(UserRequest $request)
    {
        $data = $request->all();
        CreateLogUserJob::dispatch($data);
        return ClientResponse::success('User is already in queue');
    }

    public function delete($id)
    {
        if(!$user = User::find($id)) {
            abort(404);
        }
        $userData = $user;
        if($user->delete()) {
            $userData->command = 'deleted';
            // You can get info from clickhouse with this style
//            $logs = $this->client->select('SELECT * FROM users_command_logs LIMIT 2');
            ClickHouseService::run($userData);
        }
        return ClientResponse::success('User removed successfully');
    }
}
