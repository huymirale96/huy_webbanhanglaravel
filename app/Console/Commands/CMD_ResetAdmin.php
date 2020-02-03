<?php

namespace App\Console\Commands;

use App\Jobs\JobAdminAutoReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CMD_ResetAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto reset all admin account at 00:00 every Sunday';

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
     * @return mixed
     */
    public function handle()
    {
        $arr_token = [];
        foreach (User::where('status', '!=', config('const.OUT'))->get(['email', 'name', 'token']) as $i => $user) {
            $token = md5(time() . str_random(50));
            if (!in_array($token, $arr_token)) {
                $arr_token[$i] = $token;
            } else {
                $token = md5(time() . str_random(51));
                $arr_token[$i] = $token;
            }
            $data = [
                'token' => $token,
                'token_expire' => date('Y-m-d H:i:s', time()),
            ];
            User::where('email', $user->email)->update($data);
            $job = (new JobAdminAutoReset($user->email, $user->name, $token))->delay(Carbon::now()->addSeconds(5));
            dispatch($job);
        }
    }
}
