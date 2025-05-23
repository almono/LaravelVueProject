<?php

namespace App\Domains\User\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

use App\Domains\User\Events\UserRegistered;
use App\Domains\User\Mail\RegistrationEmail;

class SendRegisterEmail implements ShouldQueue
{
    /**
     * The name of the connection the job should be sent to.
     *
     * @var string|null
     */
    public $connection = 'redis';

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        Log::info('UserRegistered Event Triggered');
        Mail::to($event->user->email)->later(now()->addSeconds(15), new RegistrationEmail($event->user));
    }
}
