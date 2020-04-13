<?php

use App\Models\UserNotificationOption;
use Illuminate\Database\Migrations\Migration;

class UnrollUserNotificationOptionsBeatmapsetModding extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        UserNotificationOption::where('name', UserNotificationOption::BEATMAPSET_MODDING)->chunkById(1000, function ($chunk) {
            foreach ($chunk as $userNotificationOption) {
                $userId = $userNotificationOption->user_id;
                foreach (UserNotificationOption::BEATMAPSET_MODDING_NOTIFICATIONS as $name) {
                    $option = UserNotificationOption::firstOrCreate([
                        'name' => $name,
                        'user_id' => $userId,
                    ]);

                    $option->details = $userNotificationOption->details;

                    if (!$option->save()) {
                        Log::info("failed updating option {$name} for user id {$userId}");
                    }
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
