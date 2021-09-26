<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class UpdateRedisCacheForUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:users:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update redis data for users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $cachedUsers = Redis::get('users');
        if(isset($cachedUsers)) {
            Redis::set('users',User::getLimitedData()->get());
        }
        Log::info('Redis data for users updated');
    }
}
