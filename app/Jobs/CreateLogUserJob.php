<?php

namespace App\Jobs;

use App\Services\ClickHouseService;
use App\Services\UserService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateLogUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;

    /**
     * CreateLogUserJob constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     *
     */
    public function handle()
    {
        if($user = UserService::create($this->data)) {
            $user->command = 'created';

            // NOTE: You can get info from clickhouse with this style
            //$logs = $this->client->select('SELECT * FROM users_command_logs LIMIT 2');

            ClickHouseService::run($user);
        }
    }
}
