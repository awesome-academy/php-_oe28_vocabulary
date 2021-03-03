<?php
namespace App\Repositories\Notification;

interface NotificationRepositoryInterface
{
    public function getModel();

    public function createNotifications($userId);
}
