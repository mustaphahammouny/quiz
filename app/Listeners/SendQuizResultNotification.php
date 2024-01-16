<?php

namespace App\Listeners;

use App\Events\Finished;
use App\Notifications\ResultQuiz;

class SendQuizResultNotification
{
    /**
     * Handle the event.
     */
    public function handle(Finished $event): void
    {
        $event->member->notify(new ResultQuiz($event->attempt));
    }
}
