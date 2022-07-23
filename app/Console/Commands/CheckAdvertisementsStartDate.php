<?php

namespace App\Console\Commands;

use App\Models\Advertisement;
use App\Notifications\SendReminderAboutAdvertisement;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class CheckAdvertisementsStartDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'advertisements:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check all advertisements which could be start within 24 hours, then send notification to the user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $advertisements = Advertisement::query()->whereDate('start_date', '<=', now()->addDay()) //get the advertisements within next day
            ->whereDate('start_date', '>=', now())  // don't include perviouse ones
            ->get();

        foreach ($advertisements as  $advertisement) {
            $advertisement->user->notify(new SendReminderAboutAdvertisement());
        }
    }
}
