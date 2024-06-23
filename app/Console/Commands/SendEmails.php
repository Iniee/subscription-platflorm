<?php

namespace App\Console\Commands;

use App\Jobs\SendPostEmails;
use App\Models\Website;
use App\Mail\SendPostEmail;
use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $websites = Website::with(['subscribers', 'posts' => function ($query) {
            $query->whereDoesntHave('subscribers');
        }])->get();

        foreach ($websites as $website) {
            foreach ($website->posts as $post) {
                foreach ($website->subscribers as $subscriber) {
                    SendPostEmails::dispatch($post, $subscriber);
                }
            }
        }

        return info("Sent Successfully");
    }
}