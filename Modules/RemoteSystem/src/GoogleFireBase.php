<?php
namespace Modules\RemoteSystem\Src;

use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Message\Topics;

class GoogleFireBase
{
    /** @var string  */
    private $topic = 'news';

    public function send(string $title, string $content)
    {
        $optionBuilder = new OptionsBuilder;
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($content)->setSound('default');

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();

        $topic = new Topics;
        $topic->topic($this->topic);

        FCM::sendToTopic($topic, $option, $notification, null);
    }

    public function test()
    {
        $optionBuilder = new OptionsBuilder;
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder('from api topic test');
        $notificationBuilder->setBody('這是封來自api發出的訊息 by topic')->setSound('default');

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();

        $topic = new Topics;
        $topic->topic('news');

        $downstreamResponse = FCM::sendToTopic($topic, $option, $notification, null);

//        $numberSuccess = $downstreamResponse->numberSuccess();
//        $numberFailure = $downstreamResponse->numberFailure();
//        $numberModification = $downstreamResponse->numberModification();
        dd($downstreamResponse);
    }
}
