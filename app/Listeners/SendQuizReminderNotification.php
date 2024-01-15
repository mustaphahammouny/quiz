<?php

namespace App\Listeners;

use App\Events\Subscribed;
use App\Notifications\RemindQuiz;

class SendQuizReminderNotification
{
    /**
     * Handle the event.
     */
    public function handle(Subscribed $event): void
    {
        if ($event->quiz->start_time) {
            $event->member->notify((new RemindQuiz($event->quiz, $event->token))->delay($event->quiz->start_time));
        }
    }
}
