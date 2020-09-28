<?php

return [

    /*
    |-------------------------------------------------------------
    | Incoming webhook endpoint
    |-------------------------------------------------------------
    |
    | The endpoint which Slack generates when creating a
    | new incoming webhook. It will look something like
    | https://hooks.slack.com/services/XXXXXXXX/XXXXXXXX/XXXXXXXXXXXXXX
    |
    */

    'endpoint' => env('SLACK_ENDPOINT'),
];
