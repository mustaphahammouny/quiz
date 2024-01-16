<?php

namespace App\Providers;

use App\Events\Finished;
use App\Events\Subscribed;
use App\Listeners\SendQuizLinkNotification;
use App\Listeners\SendQuizReminderNotification;
use App\Listeners\SendQuizResultNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Subscribed::class => [
            SendQuizLinkNotification::class,
            SendQuizReminderNotification::class,
        ],
        Finished::class => [
            SendQuizResultNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
