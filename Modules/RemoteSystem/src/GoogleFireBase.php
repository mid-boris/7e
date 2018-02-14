<?php
namespace Modules\RemoteSystem\Src;

use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class GoogleFireBase
{
    public function test()
    {
        $optionBuilder = new OptionsBuilder;
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder('title test');
        $notificationBuilder->setBody('body test')->setSound('default');

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();

        $notificationKey = ['notification_test_key'];

        $downstreamResponse = FCM::sendToGroup($notificationKey, $option, $notification, null);

        $numberSuccess = $downstreamResponse->numberSuccess();
        $numberFailure = $downstreamResponse->numberFailure();
        $numberModification = $downstreamResponse->numberModification();
        dd($numberSuccess, $numberFailure, $numberModification);
    }
}
