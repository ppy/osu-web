<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Model;

class NotificationRequest extends Model
{
    protected $connection = 'mysql-store';
    protected $table = 'notification_requests';

    protected $fillable = ['user_id', 'product_id'];
}
