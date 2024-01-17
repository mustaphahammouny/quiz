<?php

namespace App\Listeners;

use App\Events\Finished;
use App\Models\User;
use App\Notifications\FinishedQuiz;

class SendFinishedQuizNotification
{
    /**
     * Handle the event.
     */
    public function handle(Finished $event): void
    {
        $user = User::first();

        $user->notify(new FinishedQuiz($event->member, $event->attempt));
    }
}
