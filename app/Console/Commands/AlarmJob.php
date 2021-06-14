<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Alarm;
use Illuminate\Support\Facades\Mail;


class AlarmJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alarm:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a Daily email to all users with a word and its meaning';

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
        $user = User::where([['role_id',"=",4],['status',"=",1]])->get();
        $description = Alarm::first()->toArray();
        foreach ($users as $user) {
            Mail::send('emails.alarm', ["data" =>  $description], function ($msg) use ($user) {
                $msg->from('laurenpratama777@gmail.com', 'Manager Development')->to($user->email);
            });
        }
        $this->info('Word of the Day sent to All Users');
    }
}
