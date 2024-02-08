<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Jobs\SendNotification;
use App\Notifications\NotifyToUsers;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\RateLimiter;

class SendNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->onQueue(config('queue.queue_names')['notification_user']);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        User::all()->each(fn(User $user) => $user->notify(new NotifyToUsers));
    }

    public function tags()
    {
        return ['Notification'];
    }
}
