<?php

namespace App\Traits;

use Berkayk\OneSignal\OneSignalFacade as Onesignal;
use Illuminate\Support\Facades\Log;

trait Notification
{
    //send notification
    public static function sendPush($fields, $message,$headings){
        $params = [];
        $params['include_player_ids'] = $fields['player_ids'] ?? [];
        $contents = [
            "en" => $message,
        ];
        $headings = [
            "en" => $headings,
        ];
        $params['contents'] = $contents;
        $params['headings'] = $headings;
        $params['data'] = $fields['data'];

        if (count($params['include_player_ids']) > 0){
            OneSignal::sendNotificationCustom($params);
        }

        return true;
    }
}
