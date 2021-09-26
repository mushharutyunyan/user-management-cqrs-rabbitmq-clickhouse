<?php

namespace App\Services;

use App\Models\User;
use ClickHouseDB\Client;

class ClickHouseService
{
    protected static $client;
    public static function run(User $user = null)
    {
        $config = [
            'host' => env('CLICK_HOUSE_HOST', 'localhost'),
            'port' => env('CLICK_HOUSE_PORT', 8123),
            'username' => env('CLICK_HOUSE_USERNAME', 'default'),
            'password' => env('CLICK_HOUSE_PASSWORD', 'зфыыцщкв')
        ];
        self::$client = new Client($config);
        if($user) {
            self::store($user);
        }
        return self::$client;
    }


    public static function store($user)
    {
        self::$client->insert('users_command_logs',
            [
                [time(), $user->id, $user->command],
            ],
            ['event_time', 'user_id', 'command']
        );;
    }

}
