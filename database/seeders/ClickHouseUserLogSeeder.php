<?php

namespace Database\Seeders;

use App\Services\ClickHouseService;
use ClickHouseDB\Client;
use Illuminate\Database\Seeder;

class ClickHouseUserLogSeeder extends Seeder
{
    protected $client;
    public function __construct()
    {
        $this->client = ClickHouseService::run();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(empty($this->client->showTables())) {
            $this->client->write('
                CREATE TABLE IF NOT EXISTS users_command_logs (
                    event_date Date DEFAULT toDate(event_time),
                    event_time DateTime,
                    user_id Int32,
                    command String
                )
                ENGINE = SummingMergeTree(event_date, (user_id, command, event_time, event_date), 8192)
            ');
        }
    }
}
