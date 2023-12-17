<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Notifications\EventReminderNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SendEventReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-event-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sent notification to all attendees for the next event within 24 hours';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $events = Event::with('attendees.user')
            ->whereBetween('start_time', [now(), now()->addDay()])->get();
        $evenCount = $events->count();
        $eventLabel = Str::plural('event', $evenCount);

        $this->info("Found {$evenCount} {$eventLabel} within 24 hours");

        $events->each(
            fn ($event) => $event->attendees->each(
                fn ($attendee) => $attendee->user->notify(
                    new EventReminderNotification($event)
                ))
            );
        $this->info("Notifications sent successfully");
    }
}
