<?php
namespace App\Repositories\Notification;

use App\Models\Notification;
use App\Repositories\BaseRepository;
use App\Repositories\Notification\NotificationRepositoryInterface;

class NotificationRepository extends BaseRepository implements NotificationRepositoryInterface
{
    public function getModel()
    {
        return Notification::class;
    }

    public function createNotifications($userId)
    {
        Notification::create([
            'user_id' => $userId,
            'notification' => trans('home.notification')
        ]);
    }
}
