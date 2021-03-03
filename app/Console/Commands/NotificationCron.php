<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Repositories\Notification\NotificationRepositoryInterface;

class NotificationCron extends Command
{
    protected $notificationRepo;

    protected $signature = 'notify:weekly';

    protected $description = 'Send a notification for all users at 8pm every Sunday';

    public function __construct(NotificationRepositoryInterface $notificationRepo)
    {
        parent::__construct();
        $this->notificationRepo = $notificationRepo;
    }

    public function handle()
    {
        $users = User::all();
        foreach ($users as $user) {
            $this->notificationRepo->createNotifications($user->id);
        }
    }
}
