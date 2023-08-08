<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Jobs\SendPostEmail;

class SendPostEmailsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:post-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notifications for new posts';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $posts = Post::where('email_sent', false)->get();

        foreach ($posts as $post) {
            SendPostEmail::dispatch($post);
        }

        $this->info('Emails sent for new posts.');

        return Command::SUCCESS;
    }
}
