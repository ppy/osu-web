<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Model;

class NotificationRequest extends Model
{
    protected $connection = 'mysql-store';
    protected $table = 'notification_requests';

    public $timestamps = false;
}
