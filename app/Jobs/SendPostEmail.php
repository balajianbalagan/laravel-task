<?php

namespace App\Jobs;

use App\Models\Subscription;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPostEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function handle()
    {
        $postTitle = $this->post->title;
        $postDescription = $this->post->description;
        $websiteName = $this->post->website->name;

        $subscribers = Subscription::where('website_id', $this->post->website_id)->get();

        foreach ($subscribers as $subscriber) {
            $user = $subscriber->user;
            $email = $user ? $user->email : 'balaji.cea@gmail.com';

            Mail::send('emails.new_post_notification', [
                'postTitle' => $postTitle,
                'postDescription' => $postDescription,
                'websiteName' => $websiteName,
            ], function ($message) use ($email) {
                $message->to($email)->subject('New Post Notification');
            });
        }
        $this->post->update(['email_sent' => true]);
    }
}
