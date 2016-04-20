<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Model;

class NotificationRequest extends Model
{
    protected $connection = 'mysql-store';
    protected $table = 'notification_requests';

    public $timestamps = false;

    protected $fillable = ['user_id', 'product_id'];

    public static function get($user_id, $product_id)
    {
        return self::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();
    }
}
