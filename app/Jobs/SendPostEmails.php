<?php

namespace App\Jobs;

use App\Models\Post;
use App\Models\Subscriber;
use App\Mail\SendPostEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendPostEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
 
     public function __construct(public Post $post)
     {
     }


    /**
     * Execute the job.
     */
    public function handle()
    {
        $subscribers = $this->post->website->subscribers;

        foreach ($subscribers as $subscriber) {
            // Check if this post has already been sent to this subscriber
            if (!$this->hasPostBeenSentToSubscriber($this->post, $subscriber)) {
                Mail::to($subscriber->email)->send(new SendPostEmail($this->post, $subscriber));
                // Mark post as sent to this subscriber
                $this->markPostAsSentToSubscriber($this->post, $subscriber);
            }
        }
    }

    private function hasPostBeenSentToSubscriber(Post $post, Subscriber $subscriber): bool
    {
        return $subscriber->posts()->where('posts.id', $post->id)->exists();
    }

    private function markPostAsSentToSubscriber(Post $post, Subscriber $subscriber)
    {
        $subscriber->posts()->attach($post->id);
    }
}