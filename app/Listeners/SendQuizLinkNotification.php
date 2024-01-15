<?php

namespace App\Listeners;

use App\Events\Subscribed;
use App\Notifications\LinkQuiz;

class SendQuizLinkNotification
{
    /**
     * Handle the event.
     */
    public function handle(Subscribed $event): void
    {
        $event->member->notify(new LinkQuiz($event->quiz, $event->token));
    }
}
